<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register_with_manual_class(): void
    {
        // prepare jurusan and no existing class
        $major = \App\Models\Major::create(['name' => 'RPL']);

        $response = $this->post('/register', [
            'nama' => 'Test User',
            'email' => '12345@student.smktelkom-pwt.sch.id',
            'password' => 'password',
            'password_confirmation' => 'password',
            'major_id' => $major->id,
            'class_manual' => 'Kelas 99',
            'tahun_masuk' => now()->year,
            'jenis_kelamin' => 'L',
        ]);

        if (! $this->isAuthenticated()) {
            $response->dump();
            $response->dumpSession();
        }

        $this->assertAuthenticated();
        $this->assertDatabaseHas('classes', ['name' => 'Kelas 99', 'major_id' => $major->id]);
        $this->assertDatabaseHas('users', ['email' => '12345@student.smktelkom-pwt.sch.id']);
        $response->assertRedirect(route('siswa.dashboard', absolute: false));
    }

    public function test_new_users_can_register_with_existing_class(): void
    {
        $major = \App\Models\Major::create(['name' => 'TKJ']);
        $class = \App\Models\ClassRoom::create([
            'name' => 'TKJ-1',
            'grade_level' => 10,
            'major_id' => $major->id,
            'academic_year' => now()->year . '/' . (now()->year + 1),
        ]);

        $response = $this->post('/register', [
            'nama' => 'Another User',
            'email' => '67890@student.smktelkom-pwt.sch.id',
            'password' => 'password',
            'password_confirmation' => 'password',
            'major_id' => $major->id,
            'class_id' => $class->id,
            'tahun_masuk' => now()->year,
            'jenis_kelamin' => 'P',
        ]);

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => '67890@student.smktelkom-pwt.sch.id', 'class_id' => $class->id]);
        $response->assertRedirect(route('siswa.dashboard', absolute: false));
    }
}
