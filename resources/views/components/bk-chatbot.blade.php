<!-- BK Assistant widget untuk ditampilkan di halaman manapun yang menggunakan layout app -->
<style>
    :root {
      --bk-primary: #c0392b;
      --bk-surface: #ffffff;
      --bk-surface-dark: #f5f5f5;
      --bk-text: #222;
      --bk-muted: #666;
      --bk-border: rgba(0, 0, 0, 0.08);
      --bk-shadow: 0 18px 45px rgba(0, 0, 0, 0.12);
    }

    .bk-chat-widget {
      position: fixed;
      right: 20px;
      bottom: 20px;
      z-index: 9999;
      display: flex;
      flex-direction: column;
      align-items: flex-end;
      gap: 12px;
    }

    .bk-chat-toggle {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      border: none;
      background: var(--bk-primary);
      color: white;
      font-size: 30px;
      cursor: pointer;
      display: grid;
      place-items: center;
      box-shadow: var(--bk-shadow);
    }

    .bk-chat-panel {
      width: clamp(320px, 90vw, 380px);
      max-height: 76vh;
      background: var(--bk-surface);
      border-radius: 24px;
      box-shadow: var(--bk-shadow);
      overflow: hidden;
      display: none;
      flex-direction: column;
      border: 1px solid var(--bk-border);
    }

    .bk-chat-panel.open {
      display: flex;
    }

    .bk-chat-header {
      background: var(--bk-primary);
      color: white;
      padding: 18px 18px 16px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
    }

    .bk-chat-header h2 {
      margin: 0;
      font-size: 1rem;
      line-height: 1.2;
    }

    .bk-chat-header p {
      margin: 6px 0 0;
      font-size: 0.86rem;
      opacity: 0.95;
    }

    .bk-chat-close {
      background: rgba(255,255,255,0.2);
      border: none;
      color: white;
      width: 34px;
      height: 34px;
      border-radius: 50%;
      cursor: pointer;
      font-size: 1.2rem;
      display: grid;
      place-items: center;
    }

    .bk-chat-body {
      padding: 16px;
      display: flex;
      flex-direction: column;
      gap: 12px;
      overflow-y: auto;
      min-height: 260px;
    }

    .bk-message {
      max-width: 100%;
      border-radius: 18px;
      padding: 12px 14px;
      line-height: 1.5;
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.05);
      word-break: break-word;
      color: #333; /* Pastikan teks selalu gelap */
    }

    .bk-message.user {
      margin-left: auto;
      background: var(--bk-primary);
      color: white; /* Teks putih untuk pesan user */
      text-align: right;
    }

    .bk-message.assistant {
      background: #f8f9fa; /* Background abu-abu terang */
      color: #333; /* Teks gelap untuk readability */
      border: 1px solid #e9ecef; /* Border tipis */
    }

    .bk-typing-indicator {
      font-size: 0.88rem;
      color: var(--bk-muted);
      display: none;
      padding: 0 8px;
    }

    .bk-typing-indicator.active {
      display: block;
    }

    .bk-chat-footer {
      padding: 14px 16px 18px;
      border-top: 1px solid var(--bk-border);
      background: var(--bk-surface-dark);
    }

    .bk-chat-input {
      display: flex;
      gap: 10px;
    }

    .bk-chat-input input {
      flex: 1;
      border: 1px solid rgba(0,0,0,0.12);
      border-radius: 999px;
      padding: 12px 16px;
      font-size: 0.95rem;
      outline: none;
      color: var(--bk-text);
      background: var(--bk-surface);
    }

    .bk-chat-input input::placeholder {
      color: var(--bk-muted);
    }

    .bk-chat-input input:focus {
      border-color: var(--bk-primary);
      box-shadow: 0 0 0 3px rgba(192, 57, 43, 0.1);
    }

    .bk-chat-input button {
      border: none;
      border-radius: 999px;
      background: var(--bk-primary);
      color: white;
      padding: 0 18px;
      cursor: pointer;
      font-size: 0.95rem;
      transition: background 0.2s;
    }

    .bk-chat-input button:hover {
      background: #a93226;
    }

    @media (max-width: 640px) {
      .bk-chat-widget {
        right: 12px;
        bottom: 12px;
      }
      .bk-chat-panel {
        width: min(100vw - 24px, 360px);
      }
    }

    @media (max-width: 420px) {
      .bk-chat-header,
      .bk-chat-footer {
        padding-left: 14px;
        padding-right: 14px;
      }
      .bk-chat-input input {
        padding: 10px 14px;
      }
      .bk-chat-input button {
        padding: 0 14px;
      }
    }
</style>

<div class="bk-chat-widget">
  <button id="bkChatToggle" class="bk-chat-toggle" aria-label="Buka chatbot BK">💬</button>

  <div id="bkChatPanel" class="bk-chat-panel" role="dialog" aria-modal="true" aria-label="Chat BK Assistant">
    <div class="bk-chat-header">
      <div>
        <h2>BK Assistant</h2>
        <p>Asisten BK SMK Telkom Purwokerto</p>
      </div>
      <button id="bkChatClose" class="bk-chat-close" aria-label="Tutup chat">×</button>
    </div>

    <div id="bkChatBody" class="bk-chat-body">
      <div class="bk-message assistant">Halo! Saya BK Assistant dari SMK Telkom Purwokerto. Ada yang bisa saya bantu hari ini?</div>
    </div>

    <div class="bk-typing-indicator" id="bkTypingIndicator">sedang mengetik...</div>

    <div class="bk-chat-footer">
      <form id="bkChatForm" class="bk-chat-input">
        <input id="bkChatInput" type="text" placeholder="Tulis pesan..." autocomplete="off" required />
        <button type="submit">Kirim</button>
      </form>
    </div>
  </div>
</div>

<script>
  const GEMINI_URL = "{{ route('bk-assistant.message') }}";
  const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

  const bkChatToggle = document.getElementById('bkChatToggle');
  const bkChatPanel = document.getElementById('bkChatPanel');
  const bkChatClose = document.getElementById('bkChatClose');
  const bkChatForm = document.getElementById('bkChatForm');
  const bkChatInput = document.getElementById('bkChatInput');
  const bkChatBody = document.getElementById('bkChatBody');
  const bkTypingIndicator = document.getElementById('bkTypingIndicator');

  const maxHistory = 12;
  const conversation = [
    {
      role: 'SYSTEM',
      content: `Kamu adalah Asisten BK (Bimbingan Konseling) digital SMK Telkom Purwokerto bernama "BK Assistant".

PERAN & TUGAS:
- Mendampingi siswa SMK dalam bidang: akademik, karir & jurusan, sosial-emosional, dan pengembangan diri
- Memberikan informasi jurusan kuliah, beasiswa, dan dunia kerja bidang teknologi/telekomunikasi
- Membantu siswa yang sedang menghadapi masalah pertemanan, motivasi belajar, atau tekanan dari keluarga

CARA BERKOMUNIKASI:
- Gunakan bahasa Indonesia yang ramah, hangat, dan mudah dipahami remaja
- Jawab singkat dan to-the-point (2-4 kalimat), tapi tetap empatik
- Boleh pakai emoji secukupnya agar terasa lebih dekat
- Jangan terkesan kaku atau seperti robot
- Jika pertanyaan di luar konteks BK, tolak dengan sopan dan arahkan kembali ke topik BK

BATASAN PENTING:
- Jika siswa menunjukkan tanda distress berat, sarankan segera menemui Guru BK secara langsung
- Jangan memberikan diagnosis medis atau psikologis
- Fokus pada pendampingan dan motivasi, bukan menghakimi

KONTEKS SEKOLAH:
- Nama sekolah: SMK Telkom Purwokerto
- Lokasi: Purwokerto, Jawa Tengah
- Jurusan: Rekayasa Perangkat Lunak (RPL), Teknik Komputer Jaringan (TKJ), Teknik Elektronika Industri (TEI), Broadcast
- Ruang BK ada di lantai 1

Mulai percakapan dengan menyapa siswa secara hangat.`
    }
  ];

  // Fungsi untuk menyimpan percakapan ke localStorage
  function saveConversation() {
    try {
      const chatData = {
        messages: conversation.filter(msg => msg.role !== 'SYSTEM'), // Jangan simpan system message
        timestamp: Date.now()
      };
      localStorage.setItem('bk_chat_conversation', JSON.stringify(chatData));
    } catch (error) {
      console.warn('Gagal menyimpan percakapan:', error);
    }
  }

  // Fungsi untuk memuat percakapan dari localStorage
  function loadConversation() {
    try {
      const savedData = localStorage.getItem('bk_chat_conversation');
      if (!savedData) return;

      const chatData = JSON.parse(savedData);
      const now = Date.now();
      const tenMinutes = 10 * 60 * 1000; // 10 menit dalam milliseconds

      // Hapus percakapan jika lebih dari 10 menit
      if (now - chatData.timestamp > tenMinutes) {
        localStorage.removeItem('bk_chat_conversation');
        return;
      }

      // Muat pesan yang tersimpan
      chatData.messages.forEach(msg => {
        conversation.push(msg);
        addMessage(msg.role, msg.content);
      });
    } catch (error) {
      console.warn('Gagal memuat percakapan:', error);
      localStorage.removeItem('bk_chat_conversation'); // Hapus data yang rusak
    }
  }

  // Fungsi untuk menghapus percakapan (dipanggil saat logout)
  function clearConversation() {
    conversation.splice(1); // Hapus semua kecuali system message
    localStorage.removeItem('bk_chat_conversation');
    // Hapus semua pesan dari UI kecuali pesan awal
    const messages = bkChatBody.querySelectorAll('.bk-message');
    messages.forEach(msg => {
      if (!msg.textContent.includes('Halo! Saya BK Assistant')) {
        msg.remove();
      }
    });
  }

  function toggleChat() {
    bkChatPanel.classList.toggle('open');
    if (bkChatPanel.classList.contains('open')) {
      bkChatInput.focus();
    }
  }

  function addMessage(role, text) {
    const messageEl = document.createElement('div');
    messageEl.className = 'bk-message ' + (role === 'USER' ? 'user' : role === 'ASSISTANT' ? 'assistant' : '');
    messageEl.textContent = text;
    bkChatBody.appendChild(messageEl);
    bkChatBody.scrollTop = bkChatBody.scrollHeight;
    // Simpan percakapan setiap kali ada pesan baru
    saveConversation();
  }

  function setTyping(active) {
    bkTypingIndicator.classList.toggle('active', active);
  }

  function trimHistory() {
    while (conversation.length > maxHistory + 1) {
      conversation.splice(1, 1);
    }
  }

  async function sendMessage(userText) {
    addMessage('USER', userText);
    conversation.push({ role: 'USER', content: userText });
    trimHistory();
    bkChatInput.value = '';
    bkChatInput.disabled = true;
    setTyping(true);

    try {
      const body = {
        messages: conversation.map(entry => ({
          author: entry.role.toLowerCase() === 'system' ? 'system' : entry.role.toLowerCase() === 'assistant' ? 'assistant' : 'user',
          content: [{ type: 'text', text: entry.content }]
        }))
      };

      const response = await fetch(GEMINI_URL, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': CSRF_TOKEN
        },
        body: JSON.stringify(body)
      });

      if (!response.ok) {
        let errorMessage = 'Gagal memanggil layanan AI';
        try {
          const errorData = await response.json();
          errorMessage = errorData.error || errorMessage;
        } catch (e) {
          const errorText = await response.text();
          errorMessage = errorText || errorMessage;
        }
        throw new Error(errorMessage);
      }

      const data = await response.json();

      if (data.error) {
        let detailText = data.details ? ' (' + data.details + ')' : '';
        throw new Error(data.error + detailText);
      }

      const output = data.text || 'Maaf, saya belum bisa menjawab sekarang.';

      addMessage('ASSISTANT', output);
      conversation.push({ role: 'ASSISTANT', content: output });
      trimHistory();
    } catch (error) {
      addMessage('ASSISTANT', 'Maaf, terjadi masalah saat menghubungkan ke layanan. Silakan coba lagi.');
      console.error('Gemini error:', error);
    } finally {
      bkChatInput.disabled = false;
      setTyping(false);
      bkChatInput.focus();
    }
  }

  bkChatToggle.addEventListener('click', toggleChat);
  bkChatClose.addEventListener('click', () => bkChatPanel.classList.remove('open'));

  bkChatForm.addEventListener('submit', event => {
    event.preventDefault();
    const text = bkChatInput.value.trim();
    if (!text) return;
    sendMessage(text);
  });

  bkChatInput.addEventListener('keydown', event => {
    if (event.key === 'Enter' && !event.shiftKey) {
      event.preventDefault();
      bkChatForm.dispatchEvent(new Event('submit', { cancelable: true, bubbles: true }));
    }
  });

  // Muat percakapan saat halaman dimuat
  document.addEventListener('DOMContentLoaded', loadConversation);

  // Fungsi untuk logout (bisa dipanggil dari luar)
  window.clearBkChatConversation = clearConversation;
</script>
