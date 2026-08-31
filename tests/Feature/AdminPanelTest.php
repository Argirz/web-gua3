<?php

namespace Tests\Feature;

use App\Models\Brosur;
use App\Models\FotoRumah;
use App\Models\Pengguna;
use App\Models\Pengaturan;
use App\Models\Prospek;
use App\Models\SerahTerima;
use App\Models\TipeRumah;
use App\Models\UnitRumah;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    protected Pengguna $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');

        $this->admin = Pengguna::factory()->create(['role' => 'admin']);
        $this->actingAs($this->admin);
    }

    public function test_halaman_login_dan_autentikasi(): void
    {
        auth()->logout();
        $this->get('/admin/login')->assertOk();
        $this->get('/admin')->assertRedirect('/admin/login');

        $this->post('/admin/login', ['username' => 'salah', 'password' => 'salah'])
            ->assertSessionHasErrors('username');

        auth()->login($this->admin);
        $this->get('/admin')->assertOk();
    }

    public function test_dashboard(): void
    {
        $this->get('/admin')
            ->assertOk()
            ->assertSee('Dashboard');
    }

    public function test_prospek_index_filter_export_baca_status_hapus(): void
    {
        $tipe = TipeRumah::create([
            'name' => 'Tipe 36',
            'slug' => 'tipe-36',
            'land_area' => 60,
            'building_area' => 36,
            'price' => 300000000,
            'active' => true,
        ]);

        $p1 = Prospek::create(['nama_lengkap' => 'Budi Santoso', 'nomor_wa' => '081111111111', 'tipe_rumah_id' => $tipe->id, 'sumber' => 'brosur', 'status' => 'baru']);
        $p2 = Prospek::create(['nama_lengkap' => 'Ani Lestari', 'nomor_wa' => '082222222222', 'sumber' => 'sosmed', 'status' => 'deal']);

        $this->get('/admin/prospek')->assertOk();
        $this->get('/admin/prospek?status=baru&cari=Budi')->assertOk();
        $this->get("/admin/prospek/{$p1->id}/baca")->assertRedirect()->assertSessionHas('sukses');
        $this->patch("/admin/prospek/{$p2->id}/status", ['status' => 'gugur'])->assertRedirect()->assertSessionHas('sukses');
        $this->assertSame('gugur', $p2->fresh()->status);

        $respon = $this->get('/admin/prospek/export');
        $respon->assertOk();
        $this->assertStringContainsString('Budi Santoso', $respon->getContent());

        $this->delete("/admin/prospek/{$p1->id}")->assertRedirect()->assertSessionHas('sukses');
        $this->assertDatabaseMissing('prospek', ['id' => $p1->id]);
    }

    public function test_unit_crud(): void
    {
        $tipe = TipeRumah::create([
            'name' => 'Tipe 45',
            'slug' => 'tipe-45',
            'land_area' => 72,
            'building_area' => 45,
            'price' => 400000000,
            'active' => true,
        ]);

        $unit = UnitRumah::create(['block' => 'A1', 'unit_type_id' => $tipe->id, 'status' => 'tersedia']);

        $this->get('/admin/unit')->assertOk();
        $this->get('/admin/unit?status=dipesan')->assertOk();

        $this->post('/admin/unit', ['block' => 'B2', 'unit_type_id' => $tipe->id, 'status' => 'tersedia'])
            ->assertRedirect()
            ->assertSessionHas('sukses');
        $this->assertDatabaseHas('unit_rumah', ['block' => 'B2']);

        $this->post('/admin/unit', ['block' => '', 'unit_type_id' => 999])->assertSessionHasErrors(['block', 'unit_type_id', 'status']);

        $this->patch("/admin/unit/{$unit->id}/status", ['status' => 'terjual'])->assertRedirect()->assertSessionHas('sukses');
        $this->assertSame('terjual', $unit->fresh()->status);

        $this->delete("/admin/unit/{$unit->id}")->assertRedirect()->assertSessionHas('sukses');
        $this->assertDatabaseMissing('unit_rumah', ['id' => $unit->id]);
    }

    public function test_tipe_rumah_crud_dan_ubah_harga(): void
    {
        Storage::fake('public');

        $tipe = TipeRumah::create([
            'name' => 'Tipe 54',
            'slug' => 'tipe-54',
            'land_area' => 80,
            'building_area' => 54,
            'price' => 500000000,
            'active' => true,
        ]);

        $this->get('/admin/tipe')->assertOk();
        $this->get('/admin/tipe/buat')->assertOk();
        $this->get("/admin/tipe/{$tipe->id}/edit")->assertOk();

        $this->post('/admin/tipe', [
            'name' => 'Tipe 70',
            'land_area' => 100,
            'building_area' => 70,
            'price' => 700000000,
            'bedrooms' => 3,
            'bathrooms' => 2,
            'active' => '1',
        ])->assertRedirect()->assertSessionHas('sukses');
        $this->assertDatabaseHas('tipe_rumah', ['name' => 'Tipe 70']);

        $this->put("/admin/tipe/{$tipe->id}", [
            'name' => 'Tipe 54 Baru',
            'land_area' => 85,
            'building_area' => 54,
            'price' => 520000000,
            'discount' => 10000000,
        ])->assertRedirect()->assertSessionHas('sukses');

        $this->patch("/admin/tipe/{$tipe->id}/harga", ['price' => 555000000])->assertRedirect()->assertSessionHas('sukses');
        $this->assertSame(555000000.0, (float) $tipe->fresh()->price);

        $unit = UnitRumah::create(['block' => 'C3', 'unit_type_id' => $tipe->id, 'status' => 'tersedia']);
        $this->delete("/admin/tipe/{$tipe->id}")->assertSessionHasErrors('tipe');
        $unit->delete();

        $this->delete("/admin/tipe/{$tipe->id}")->assertRedirect()->assertSessionHas('sukses');
        $this->assertDatabaseMissing('tipe_rumah', ['id' => $tipe->id]);
    }

    public function test_foto_crud(): void
    {
        $foto = FotoRumah::create([
            'title' => 'Foto Unit',
            'kategori' => 'unit',
            'image' => 'images/galeri/fake.webp',
            'active' => true,
        ]);

        $this->get('/admin/foto')->assertOk();
        $this->get('/admin/foto?kategori=siteplan')->assertOk();
        $this->get('/admin/foto/buat')->assertOk();
        $this->get("/admin/foto/{$foto->id}/edit")->assertOk();

        $gambar = UploadedFile::fake()->image('test.jpg', 10, 10);

        $this->post('/admin/foto', [
            'title' => 'Foto Baru',
            'image' => $gambar,
            'kategori' => 'serah_terima',
            'active' => '1',
        ])->assertRedirect()->assertSessionHasNoErrors()->assertSessionHas('sukses');
        $this->assertDatabaseHas('foto_rumah', ['title' => 'Foto Baru']);

        $this->put("/admin/foto/{$foto->id}", [
            'title' => 'Foto Unit Edit',
            'kategori' => 'unit',
        ])->assertRedirect()->assertSessionHas('sukses');

        $this->delete("/admin/foto/{$foto->id}")->assertRedirect()->assertSessionHas('sukses');
        $this->assertDatabaseMissing('foto_rumah', ['id' => $foto->id]);
    }

    public function test_brosur_crud(): void
    {
        Storage::fake('public');

        $brosur = Brosur::create([
            'kategori' => 'brosur',
            'title' => 'Brosur 2026',
            'file' => 'brosur/fake.pdf',
            'active' => true,
        ]);

        $this->get('/admin/brosur')->assertOk();
        $this->get('/admin/brosur/buat')->assertOk();
        $this->get("/admin/brosur/{$brosur->id}/edit")->assertOk();

        $pdf = UploadedFile::fake()->create('dokumen.pdf', 50, 'application/pdf');

        $this->post('/admin/brosur', [
            'kategori' => 'pricelist',
            'title' => 'Pricelist 2026',
            'file' => $pdf,
            'sort_order' => 2,
            'active' => '1',
        ])->assertRedirect()->assertSessionHasNoErrors()->assertSessionHas('sukses');
        $this->assertDatabaseHas('brosur', ['title' => 'Pricelist 2026', 'kategori' => 'pricelist']);

        $this->put("/admin/brosur/{$brosur->id}", [
            'kategori' => 'brosur',
            'title' => 'Brosur 2026 Edit',
            'sort_order' => 1,
        ])->assertRedirect()->assertSessionHas('sukses');

        $this->delete("/admin/brosur/{$brosur->id}")->assertRedirect()->assertSessionHas('sukses');
        $this->assertDatabaseMissing('brosur', ['id' => $brosur->id]);
    }

    public function test_serah_terima_crud(): void
    {
        $tipe = TipeRumah::create([
            'name' => 'Tipe 36 ST',
            'slug' => 'tipe-36-st',
            'land_area' => 60,
            'building_area' => 36,
            'price' => 300000000,
            'active' => true,
        ]);
        $unit = UnitRumah::create(['block' => 'D4', 'unit_type_id' => $tipe->id, 'status' => 'terjual']);

        $st = SerahTerima::create([
            'customer' => 'Pak Budi',
            'unit_rumah_id' => $unit->id,
            'image' => 'images/serah-terima/fake.webp',
            'handover_date' => '2026-01-15',
            'active' => true,
        ]);

        $this->get('/admin/serah-terima')->assertOk();
        $this->get('/admin/serah-terima/buat')->assertOk();
        $this->get("/admin/serah-terima/{$st->id}/edit")->assertOk();

        $gambar = UploadedFile::fake()->image('serah.jpg', 10, 10);

        $this->post('/admin/serah-terima', [
            'customer' => 'Bu Ani',
            'unit_rumah_id' => $unit->id,
            'image' => $gambar,
            'caption' => 'Serah terima kunci Blok D4',
            'handover_date' => '2026-02-20',
            'active' => '1',
        ])->assertRedirect()->assertSessionHasNoErrors()->assertSessionHas('sukses');
        $this->assertDatabaseHas('serah_terima', ['customer' => 'Bu Ani']);

        $this->put("/admin/serah-terima/{$st->id}", [
            'customer' => 'Pak Budi Edit',
            'unit_rumah_id' => $unit->id,
            'handover_date' => '2026-01-16',
        ])->assertRedirect()->assertSessionHas('sukses');

        $this->delete("/admin/serah-terima/{$st->id}")->assertRedirect()->assertSessionHas('sukses');
        $this->assertDatabaseMissing('serah_terima', ['id' => $st->id]);
    }

    public function test_pengaturan(): void
    {
        $this->get('/admin/pengaturan')->assertOk();

        $this->post('/admin/pengaturan', [
            'nama_perumahan' => 'Griya Utama Asri 3',
            'whatsapp' => '08123456789',
        ])->assertRedirect()->assertSessionHas('sukses');

        $this->assertDatabaseHas('pengaturan', ['key' => 'nama_perumahan', 'value' => 'Griya Utama Asri 3']);
        $this->assertDatabaseHas('pengaturan', ['key' => 'whatsapp', 'value' => '08123456789']);
        $this->assertNotNull(Pengaturan::where('key', 'email')->first());
    }

    public function test_pencarian_global(): void
    {
        TipeRumah::create([
            'name' => 'Tipe Cari',
            'slug' => 'tipe-cari',
            'land_area' => 60,
            'building_area' => 36,
            'price' => 300000000,
            'active' => true,
        ]);
        Prospek::create(['nama_lengkap' => 'Cari Budi', 'nomor_wa' => '083333333333', 'sumber' => 'kontak', 'status' => 'baru']);
        UnitRumah::create(['block' => 'Z9', 'unit_type_id' => TipeRumah::first()->id, 'status' => 'tersedia']);
        Brosur::create(['kategori' => 'brosur', 'title' => 'Brosur Cari', 'file' => 'x.pdf']);

        $this->get('/admin/search?q=Cari')->assertOk();
        $this->get('/admin/search?q=')->assertOk();
    }
}
