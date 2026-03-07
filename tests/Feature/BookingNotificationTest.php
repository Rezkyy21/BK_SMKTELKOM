<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\GuruBk;
use App\Models\Siswa;
use App\Models\Jadwal;
use App\Models\Topik;
use App\Models\Booking;
use App\Notifications\KonselingBookedNotification;
use App\Notifications\KonselingStatusNotification;

class BookingNotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guru_receives_database_notification_when_booking_is_created()
    {
        // intercept outgoing notifications
        \Illuminate\Support\Facades\Notification::fake();

        // prepare data
        $guruUser = User::factory()->create(['role' => 'guru']);
        $guru = GuruBk::create([
            'user_id' => $guruUser->id,
            'nip' => '123456',
            'nama' => 'Pak Guru',
            'status' => 'aktif',
        ]);

        $jadwal = Jadwal::create([
            'guru_id' => $guru->id,
            'hari' => 'senin',
            'jam_mulai' => '08:00',
            'jam_selesai' => '09:00',
            'kuota' => 5,
            'is_active' => true,
        ]);

        $topik = Topik::create(['nama' => 'Masalah Akademik']);

        $siswaUser = User::factory()->create(['role' => 'siswa']);
        $siswa = Siswa::create([
            'user_id' => $siswaUser->id,
            'nis' => '001',
            'nama' => 'Siswa A',
            'kelas' => '10A',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Jl. Contoh',
        ]);

        // act as siswa and submit booking
        $response = $this->actingAs($siswaUser)->post(route('siswa.konseling.store'), [
            'jadwal_id' => $jadwal->id,
            'tanggal' => now()->toDateString(),
            'tipe_konseling' => 'individu',
            'topik_id' => $topik->id,
            'catatan_siswa' => 'Saya butuh bantuan',
        ]);

        $response->assertRedirect(route('siswa.konseling')); // check redirect

        // ensure guru received a database notification
        $this->assertDatabaseHas('notifications', [
            'notifiable_id' => $guruUser->id,
            'type' => KonselingBookedNotification::class,
        ]);

        // also check mail channel via Notification fake
        \Illuminate\Support\Facades\Notification::assertSentTo(
            $guruUser,
            KonselingBookedNotification::class,
            function ($notification, $channels) {
                return in_array('mail', $channels);
            }
        );
    }

    public function test_siswa_notified_when_booking_status_changes()
    {
        // intercept outgoing notifications
        \Illuminate\Support\Facades\Notification::fake();

        $guruUser = User::factory()->create(['role' => 'guru']);
        $guru = GuruBk::create([
            'user_id' => $guruUser->id,
            'nip' => '123457',
            'nama' => 'Bu Guru',
            'status' => 'aktif',
        ]);

        $jadwal = Jadwal::create([
            'guru_id' => $guru->id,
            'hari' => 'selasa',
            'jam_mulai' => '10:00',
            'jam_selesai' => '11:00',
            'kuota' => 3,
            'is_active' => true,
        ]);

        $topik = Topik::create(['nama' => 'Konseling Pribadi']);

        $siswaUser = User::factory()->create(['role' => 'siswa']);
        $siswa = Siswa::create([
            'user_id' => $siswaUser->id,
            'nis' => '002',
            'nama' => 'Siswa B',
            'kelas' => '11B',
            'jenis_kelamin' => 'Perempuan',
            'alamat' => 'Jl. Test',
        ]);

        $booking = Booking::create([
            'jadwal_id' => $jadwal->id,
            'tanggal' => now()->addDay()->toDateString(),
            'siswa_id' => $siswa->id,
            'topik_id' => $topik->id,
            'tipe_konseling' => 'individu',
            'catatan_siswa' => 'Harap dibantu',
            'status' => 'menunggu',
            'mode_konseling' => 'offline',
            'mode_identitas' => 'asli',
        ]);

        // change status to disetujui
        $booking->update(['status' => 'disetujui']);

        $this->assertDatabaseHas('notifications', [
            'notifiable_id' => $siswaUser->id,
            'type' => KonselingStatusNotification::class,
        ]);

        \Illuminate\Support\Facades\Notification::assertSentTo(
            $siswaUser,
            KonselingStatusNotification::class,
            function ($notification, $channels) {
                return in_array('mail', $channels);
            }
        );

        // also test rejection path
        $booking->status = 'menunggu';
        $booking->save();
        $booking->update(['status' => 'ditolak']);
        $this->assertDatabaseHas('notifications', [
            'notifiable_id' => $siswaUser->id,
            'type' => KonselingStatusNotification::class,
        ]);
        \Illuminate\Support\Facades\Notification::assertSentTo(
            $siswaUser,
            KonselingStatusNotification::class,
            function ($notification, $channels) {
                return in_array('mail', $channels);
            }
        );
    }

    public function test_guru_can_approve_and_reject_via_dashboard_routes()
    {
        // prepare guru and booking
        $guruUser = User::factory()->create(['role' => 'guru_bk']);
        $guru = GuruBk::create([
            'user_id' => $guruUser->id,
            'nip' => '999999',
            'nama' => 'Guru Tujuan',
            'status' => 'aktif',
        ]);

        $jadwal = Jadwal::create([
            'guru_id' => $guru->id,
            'hari' => 'rabu',
            'jam_mulai' => '13:00',
            'jam_selesai' => '14:00',
            'kuota' => 2,
            'is_active' => true,
        ]);

        $topik = Topik::create(['nama' => 'Uji Route']);

        $siswaUser = User::factory()->create(['role' => 'siswa']);
        $siswa = Siswa::create([
            'user_id' => $siswaUser->id,
            'nis' => '003',
            'nama' => 'Siswa C',
            'kelas' => '12C',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Jl. Fake',
        ]);

        $booking = Booking::create([
            'jadwal_id' => $jadwal->id,
            'tanggal' => now()->toDateString(),
            'siswa_id' => $siswa->id,
            'topik_id' => $topik->id,
            'tipe_konseling' => 'individu',
            'catatan_siswa' => 'Test approve',
            'status' => 'menunggu',
            'mode_konseling' => 'offline',
            'mode_identitas' => 'asli',
        ]);

        // guru approves via route
        $this->actingAs($guruUser)
            ->post(route('guru.bookings.approve', $booking))
            ->assertRedirect();
        $this->assertEquals('disetujui', $booking->fresh()->status);

        // change back to pending for rejection test
        $booking->status = 'menunggu';
        $booking->save();

        // reject
        $this->actingAs($guruUser)
            ->post(route('guru.bookings.reject', $booking), ['reason' => 'Saya tidak bisa'])
            ->assertRedirect();
        $this->assertEquals('ditolak', $booking->fresh()->status);
        $this->assertEquals('Saya tidak bisa', $booking->fresh()->catatan_siswa);
    }
}
