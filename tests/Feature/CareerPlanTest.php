<?php

namespace Tests\Feature;

use App\Models\CareerPlan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CareerPlanTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function siswa_can_submit_kuliah_plan_with_extra_details()
    {
        $user = User::factory()->create(['role' => 'siswa']);

        $this->actingAs($user);

        $response = $this->patch(route('career-plan.update'), [
            'category' => 'kuliah',
            'student_name' => 'Budi Santoso',
            'nis' => '123456',
            'class_name' => '12 RPL 1',
            'graduation_year' => 2025,
            'campus_name' => 'Universitas Contoh',
            'study_program' => 'Teknik Informatika',
            'entrance_year' => 2026,
            'target_university' => 'ITB',
            'target_major' => 'TI',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('career_plans', [
            'user_id' => $user->id,
            'category' => 'kuliah',
            'student_name' => 'Budi Santoso',
            'nis' => '123456',
            'class_name' => '12 RPL 1',
            'graduation_year' => 2025,
            'campus_name' => 'Universitas Contoh',
            'study_program' => 'Teknik Informatika',
            'entrance_year' => 2026,
            'target_university' => 'ITB',
            'target_major' => 'TI',
        ]);
    }

    /** @test */
    public function siswa_can_submit_kerja_plan()
    {
        $user = User::factory()->create(['role' => 'siswa']);
        $this->actingAs($user);

        $response = $this->patch(route('career-plan.update'), [
            'category' => 'kerja',
            'student_name' => 'Andi',
            'nis' => '111222',
            'class_name' => '12 TKJ 2',
            'graduation_year' => 2025,
            'target_company' => 'ABC Corp',
            'target_position' => 'Developer',
            'accepted_year' => 2025,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('career_plans', [
            'user_id' => $user->id,
            'category' => 'kerja',
            'student_name' => 'Andi',
            'nis' => '111222',
            'class_name' => '12 TKJ 2',
            'graduation_year' => 2025,
            'target_company' => 'ABC Corp',
            'target_position' => 'Developer',
            'accepted_year' => 2025,
        ]);
    }

    /** @test */
    public function siswa_can_submit_usaha_plan()
    {
        $user = User::factory()->create(['role' => 'siswa']);
        $this->actingAs($user);

        $response = $this->patch(route('career-plan.update'), [
            'category' => 'usaha',
            'student_name' => 'Citra',
            'nis' => '333444',
            'class_name' => '12 TJA 3',
            'graduation_year' => 2024,
            'business_type' => 'Online Store',
            'business_name' => 'Toko XYZ',
            'established_year' => 2025,
            'business_idea' => 'Jualan online',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('career_plans', [
            'user_id' => $user->id,
            'category' => 'usaha',
            'student_name' => 'Citra',
            'nis' => '333444',
            'class_name' => '12 TJA 3',
            'graduation_year' => 2024,
            'business_type' => 'Online Store',
            'business_name' => 'Toko XYZ',
            'established_year' => 2025,
            'business_idea' => 'Jualan online',
        ]);
    }

    /** @test */
    public function siswa_can_direct_submit_without_prior_draft()
    {
        $user = User::factory()->create(['role' => 'siswa']);
        $this->actingAs($user);

        $response = $this->patch(route('career-plan.update'), [
            'category' => 'kerja',
            'student_name' => 'Rina',
            'nis' => '777888',
            'class_name' => '12 RPL 1',
            'graduation_year' => 2025,
            'target_company' => 'XYZ Corp',
            'target_position' => 'QA Engineer',
            'accepted_year' => 2025,
            'action' => 'submit',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('career_plans', [
            'user_id' => $user->id,
            'category' => 'kerja',
            'status' => 'submitted',
        ]);

        $careerPlan = CareerPlan::where('user_id', $user->id)->first();
        $this->assertNotNull($careerPlan);
        $this->assertNotNull($careerPlan->submitted_at);
    }
}