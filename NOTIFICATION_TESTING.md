# Testing WhatsApp Notification System

## System Overview
✅ **Two notification display locations:**
1. **Notification Bell** (Top-Right in Navigation) - Shows 3 latest notifications with dropdown
2. **Konseling Page Alert** - Large green banner when booking is approved

---

## Testing Steps

### Prerequisites
1. Make sure at least one **Guru BK has WhatsApp number** filled in admin panel
   - Go to Admin → Guru BK → Edit Guru → Fill "Nomor WhatsApp" field
   - Format: `628123456789` (no + or spaces)

2. Have **at least one pending booking** ready to approve
   - Or create a test booking as a siswa account

### Test Flow

#### Step 1: Create/Find a Pending Booking
- **As Siswa:** Go to Konseling page → Select Guru BK → Select Schedule → Submit Booking
- Status should be "Menunggu" (Pending)

#### Step 2: Approve Booking from Admin
- Login as **Admin**
- Go to **Filament Dashboard** → **Bookings**
- Click **"Detail"** on a "Menunggu" (pending) booking
- Click **"Setujui Konseling"** (green button)
- Should see confirmation that notification was sent

#### Step 3: Check Notification in Siswa Account
- Note down which **siswa user** the booking was made for
- **Logout** from admin account
- **Login as the siswa** user
- You should see:

**Option A - On Konseling Page (Recommended)**
- Large **green alert box** at the top of the page
- Shows: "✅ Booking Anda Telah Disetujui!"
- Contains message: "Booking konseling kamu telah disetujui oleh [Guru Name]."
- **Green WhatsApp button** with icon → Click to open WhatsApp
- **Close button (✕)** to dismiss

**Option B - In Notification Bell (Top-Right)**
- Look for **notification bell icon** with **red badge** showing count
- Click on bell → Dropdown appears
- Should show notification entry with WhatsApp button
- Click "Tandai Semua Dibaca" to mark as read

---

## What Happens When You Click WhatsApp Button

1. Opens WhatsApp Web to the guru's number
2. Pre-filled message: "Halo [Guru Name], saya ingin mengkonfirmasi jadwal konseling."
3. Can start chatting immediately

---

## Troubleshooting

### ❌ WhatsApp Button Not Showing
**Possible Causes:**
- [ ] Guru doesn't have WhatsApp number filled in admin panel
- [ ] Number format is incorrect (needs to be like `628123456789`)
- [ ] Browser cache - try refresh (Ctrl+F5) or clear cache

**Solution:**
1. Check Admin → Guru BK → Make sure "Nomor WhatsApp" is filled
2. Format must be: **628 followed by Indonesia number** (no + or spaces)

### ❌ Notification Not Appearing
**Possible Causes:**
- [ ] Queue job not processed - check if Laravel queue is running
- [ ] Database notification not saved - check database "notifications" table
- [ ] User was logged out during notification send

**Solution:**
```bash
# Check if queue is running
php artisan queue:failed

# Retry failed jobs
php artisan queue:retry all

# Or process queue synchronously (for testing)
# Edit .env: QUEUE_CONNECTION=sync
```

### ❌ WhatsApp Link Opens Wrong Number
- Check guru's WhatsApp number format
- Remove any non-numeric characters except the country code (62)
- Example: `+62 812 3456 789` → `628123456789`

---

## Database Verification

To manually check if notification was saved:

```sql
-- Check notifications table
SELECT * FROM notifications 
WHERE notifiable_id = {siswa_user_id} 
AND type = 'App\\Notifications\\BookingDiterimaNotification'
ORDER BY created_at DESC 
LIMIT 1;

-- Result should have data JSON like:
{
  "type": "booking_status",
  "message": "Booking konseling kamu telah disetujui oleh [Guru Name].",
  "booking_id": 123,
  "guru_nama": "[Guru Name]",
  "wa_link": "https://wa.me/628123456789?text=..."
}
```

---

## Expected Behavior

| Event | Expected Display | Where |
|-------|------------------|-------|
| Booking Approved | Green alert box | Konseling page (automatic on load) |
| Unread Count | Red badge on bell | Top-right navigation |
| 3 Latest Notifs | Dropdown list | Click notification bell |
| WhatsApp Button | Green button | Both konseling alert and notification dropdown |

---

## Email Verification

An email should also be sent to the siswa user with:
- Subject: "Booking Konseling Kamu Diterima!"
- Body: Message about approval + WhatsApp link button
- Check email configuration in `.env` MAIL_* settings

---

## Notes

- Notifications appear as unread until user clicks "Tandai Semua Dibaca" in dropdown
- Konseling page alert doesn't auto-mark as read (improved UX)
- WhatsApp link opens in new tab - won't disrupt current page
- Pre-filled message helps user know what to discuss with guru
