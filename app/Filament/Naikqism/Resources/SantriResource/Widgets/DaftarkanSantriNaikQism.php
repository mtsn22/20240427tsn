<?php

namespace App\Filament\Naikqism\Resources\SantriResource\Widgets;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelas;
use App\Models\Kelurahan;
use App\Models\Kodepos;
use App\Models\Provinsi;
use App\Models\Qism;
use App\Models\QismDetail;
use App\Models\QismDetailHasKelas;
use App\Models\Santri;
use App\Models\Semester;
use App\Models\TahunAjaran;
use App\Models\Walisantri;
use Carbon\Carbon;
use Closure;
use Filament\Actions\StaticAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Grid as TableGrid;
use Filament\Forms\Components\Actions\Action;
use Filament\Tables\Columns\Layout\Stack;

class DaftarkanSantriNaikQism extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static bool $isLazy = false;

    // public static function canView(): bool
    // {
    //     // dd(Auth::user());

    //     $walisantri_id = Walisantri::where('kartu_keluarga_santri', Auth::user()->username)->first();
    //     // dd($walisantri_id->is_collapse);



    //     if ($walisantri_id->is_collapse === true) {
    //         return true;
    //     } elseif ($walisantri_id->is_collapse === false) {
    //         return false;
    //     }

    //     // return auth()->user()->isAdmin();
    // }

    public function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading('Belum ada data ananda')
            ->emptyStateDescription('Belum ada data ananda yang bisa naik qism')
            ->emptyStateIcon('heroicon-o-book-open')
            ->query(

                Santri::where('kartu_keluarga', Auth::user()->username)->where('naikqism', 'naik')->whereHas('statussantri', function ($query) {
                    $query->where('status', 'aktif');
                })
            )
            ->columns([
                Stack::make([
                    TextColumn::make('index')
                        ->description(fn ($record): string => "Nomor", position: 'above')
                        ->rowIndex(),
                    TextColumn::make('nama_lengkap')
                        ->description(fn ($record): string => "Nama Calon Santri:", position: 'above'),
                    TextColumn::make('kelassantri.qism.qism')
                        ->description(fn ($record): string => "Qism saat ini", position: 'above'),
                    TextColumn::make('kelassantri.kelas.kelas')
                        ->description(fn ($record): string => "Kelas:", position: 'above'),
                    TextColumn::make('daftarnaikqism')
                        ->description(fn ($record): string => "Status:", position: 'above'),
                    TextColumn::make('qism_tujuan')
                        ->description(fn ($record): string => "ke Qism:", position: 'above'),
                    TextColumn::make('qism_detail_tujuan')
                        ->description(fn ($record): string => "", position: 'above'),
                ])

            ])
            ->headerActions([])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Daftarkan Santri Naik Qism')
                    ->modalHeading('Daftar Naik Qism')
                    ->modalDescription(new HtmlString('<div class="">
                                                            <p>Butuh bantuan?</p>
                                                            <p>Silakan mengubungi admin di bawah ini:</p>

                                                            <table class="table w-fit">
                                        <!-- head -->
                                        <thead>
                                            <tr class="border-tsn-header">
                                                <th class="text-tsn-header text-xs" colspan="2"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- row 1 -->
                                            <tr>
                                                <th><a href="https://wa.me/6282210862400"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                                                </svg>
                                                </a></th>
                                                <td class="text-xs"><a href="https://wa.me/6282210862400">WA Admin Putra (Abu Hammaam)</a></td>
                                            </tr>
                                            <tr>
                                                <th><a href="https://wa.me/6285236459012"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"  fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                                                </svg>
                                                </a></th>
                                                <td class="text-xs"><a href="https://wa.me/6285236459012">WA Admin Putra (Abu Fathimah Hendi)</a></td>
                                            </tr>
                                            <tr>
                                                <th><a href="https://wa.me/6281333838691"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"  fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                                                </svg>
                                                </a></th>
                                                <td class="text-xs"><a href="https://wa.me/6281333838691">WA Admin Putra (Akh Irfan)</a></td>
                                            </tr>
                                            <tr>
                                                <th><a href="https://wa.me/628175765767"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"  fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                                                </svg>
                                                </a></th>
                                                <td class="text-xs"><a href="https://wa.me/628175765767">WA Admin Putri</a></td>
                                            </tr>


                                        </tbody>
                                        </table>

                                                        </div>'))
                    ->modalWidth('full')
                    // ->stickyModalHeader()
                    ->button()
                    ->closeModalByClickingAway(false)
                    ->modalSubmitActionLabel('Simpan')
                    ->modalCancelAction(fn (StaticAction $action) => $action->label('Batal'))
                    ->steps([

                        Step::make('1. DAFTAR NAIK QISM')
                            ->schema([

                                Hidden::make('tahap')
                                    ->default('Tahap 1'),

                                Hidden::make('jenispendaftar')
                                    ->default('NaikQism')
                                    ->live()
                                    ->afterStateUpdated(function ($record, Get $get, ?string $state, Set $set) {
                                        // dd($get('qism_id'));
                                        $set('qism_sebelumnya', 'a');
                                    }),

                                Group::make()
                                    ->relationship('statussantri')
                                    ->schema([
                                        Hidden::make('ket_status')
                                            ->default('NaikQism'),
                                    ]),

                                Placeholder::make('')
                                    ->content(new HtmlString('<div class="border-b">
                                                    <p class="text-lg strong"><strong>SANTRI</strong></p>
                                                </div>')),

                                TextInput::make('nama_lengkap')
                                    ->label('Nama Lengkap')
                                    ->disabled()
                                    ->required(),

                                TextInput::make('nik')
                                    ->label('NIK Santri')
                                    ->length(16)
                                    ->disabled()
                                    ->required(),

                                Placeholder::make('')
                                    ->content(new HtmlString('<div class="border-b">
                                                    <p class="text-lg strong"><strong>QISM SAAT INI</strong></p>
                                                </div>')),

                                Group::make()
                                    ->relationship('kelassantri')
                                    ->schema([
                                        Hidden::make('mahad_id')
                                            ->default(1),

                                        Select::make('qism_id')
                                            ->label('Qism saat ini')
                                            ->placeholder('Pilih Qism yang dituju')
                                            ->options(Qism::all()->pluck('qism', 'id'))
                                            ->disabled()
                                            ->live()
                                            ->required()
                                            ->native(false),

                                        Select::make('qism_detail_id')
                                            ->label('')
                                            ->options(QismDetail::all()->pluck('qism_detail', 'id'))
                                            ->disabled()
                                            ->live()
                                            ->required()
                                            ->native(false),

                                        Select::make('kelas_id')
                                            ->label('Kelas saat ini')
                                            ->disabled()
                                            ->native(false)
                                            ->options(Kelas::all()->pluck('kelas', 'id'))
                                            ->required(),
                                    ]),

                                Placeholder::make('')
                                    ->content(new HtmlString('<div class="border-b">
                                                    <p class="text-lg"><strong>DIDAFTARKAN UNTUK NAIK KE QISM</strong></p>
                                                </div>')),

                                TextInput::make('qism')
                                    ->label('Qism tujuan')
                                    ->disabled()
                                    ->required()
                                    ->live(),

                                TextInput::make('qism_detail')
                                    ->label('')
                                    ->disabled()
                                    ->required()
                                    ->live(),
                            ]),
                        // end of step 1

                        Step::make('2. KUESIONER KESEHATAN')
                            ->schema([

                                Placeholder::make('')
                                    ->content(new HtmlString('<div class="border-b">
                                                    <p class="text-lg strong"><strong>KUESIONER KESEHATAN</strong></p>
                                                </div>')),
                                Group::make()
                                    ->relationship('pendaftar')
                                    ->schema([
                                        Radio::make('ps_kkes_sakit_serius')
                                            ->label('1. Apakah ananda pernah mengalami sakit yang cukup serius?')
                                            ->required()
                                            ->default('Ya')
                                            ->options([
                                                'Ya' => 'Ya',
                                                'Tidak' => 'Tidak',
                                            ])
                                            ->live(),

                                        TextArea::make('ps_kkes_sakit_serius_nama_penyakit')
                                            ->label('Jika iya, kapan dan penyakit apa?')
                                            ->required()
                                            ->default('asdad')
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('ps_kkes_sakit_serius') !== 'Ya'
                                            ),

                                        Radio::make('ps_kkes_terapi')
                                            ->label('2. Apakah ananda pernah atau sedang menjalani terapi kesehatan?')
                                            ->required()
                                            ->default('Ya')
                                            ->options([
                                                'Ya' => 'Ya',
                                                'Tidak' => 'Tidak',
                                            ])
                                            ->live(),

                                        TextArea::make('ps_kkes_terapi_nama_terapi')
                                            ->label('Jika iya, kapan dan terapi apa?')
                                            ->required()
                                            ->default('asdasd')
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('ps_kkes_terapi') !== 'Ya'
                                            ),

                                        Radio::make('ps_kkes_kambuh')
                                            ->label('3. Apakah ananda memiliki penyakit yang dapat/sering kambuh?')
                                            ->required()
                                            ->default('Ya')
                                            ->options([
                                                'Ya' => 'Ya',
                                                'Tidak' => 'Tidak',
                                            ])
                                            ->live(),

                                        TextArea::make('ps_kkes_kambuh_nama_penyakit')
                                            ->label('Jika iya, penyakit apa?')
                                            ->required()
                                            ->default('asdad')
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('ps_kkes_kambuh') !== 'Ya'
                                            ),

                                        Radio::make('ps_kkes_alergi')
                                            ->label('4. Apakah ananda memiliki alergi terhadap perkara-perkara tertentu?')
                                            ->required()
                                            ->default('Ya')
                                            ->options([
                                                'Ya' => 'Ya',
                                                'Tidak' => 'Tidak',
                                            ])
                                            ->live(),

                                        TextArea::make('ps_kkes_alergi_nama_alergi')
                                            ->label('Jika iya, sebutkan!')
                                            ->required()
                                            ->default('asdadsd')
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('ps_kkes_alergi') !== 'Ya'
                                            ),

                                        Radio::make('ps_kkes_pantangan')
                                            ->label('5. Apakah ananda mempunyai pantangan yang berkaitan dengan kesehatan?')
                                            ->required()
                                            ->default('Ya')
                                            ->options([
                                                'Ya' => 'Ya',
                                                'Tidak' => 'Tidak',
                                            ])
                                            ->live(),

                                        TextArea::make('ps_kkes_pantangan_nama')
                                            ->label('Jika iya, sebutkan dan jelaskan alasannya!')
                                            ->required()
                                            ->default('asdadssad')
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('ps_kkes_pantangan') !== 'Ya'
                                            ),

                                        Radio::make('ps_kkes_psikologis')
                                            ->label('6. Apakah ananda pernah mengalami gangguan psikologis (depresi dan gejala-gejalanya)?')
                                            ->required()
                                            ->default('Ya')
                                            ->options([
                                                'Ya' => 'Ya',
                                                'Tidak' => 'Tidak',
                                            ])
                                            ->live(),

                                        TextArea::make('ps_kkes_psikologis_kapan')
                                            ->label('Jika iya, kapan?')
                                            ->required()
                                            ->default('asdad')
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('ps_kkes_psikologis') !== 'Ya'
                                            ),

                                        Radio::make('ps_kkes_gangguan')
                                            ->label('7. Apakah ananda pernah mengalami gangguan jin?')
                                            ->required()
                                            ->default('Ya')
                                            ->options([
                                                'Ya' => 'Ya',
                                                'Tidak' => 'Tidak',
                                            ])
                                            ->live(),

                                        TextArea::make('ps_kkes_gangguan_kapan')
                                            ->label('Jika iya, kapan?')
                                            ->required()
                                            ->default('asdadsad')
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('ps_kkes_gangguan') !== 'Ya'
                                            ),

                                    ]),
                            ]),
                        // end of step 2

                        Step::make('3. KUESIONER KEMANDIRIAN')
                            ->schema([

                                Placeholder::make('')
                                    ->content(new HtmlString('<div class="border-b">
                                                    <p class="text-lg"><strong>KUESIONER KEMANDIRIAN</strong></p>
                                                    <br>
                                                    <p class="text-sm"><strong>Kuesioner ini khusus untuk calon santri Pra Tahfidz kelas 1-4</strong></p>
                                                </div>')),
                                Group::make()
                                    ->relationship('pendaftar')
                                    ->schema([
                                        Radio::make('ps_kkm_bak')
                                            ->label('1. Apakah ananda sudah bisa BAK sendiri?')
                                            // ->required()
                                            ->default('Ya')
                                            ->options([
                                                'Ya' => 'Ya',
                                                'Tidak' => 'Tidak',
                                            ]),

                                        Radio::make('ps_kkm_bab')
                                            ->label('2. Apakah ananda sudah bisa BAB sendiri?')
                                            // ->required()
                                            ->default('Ya')
                                            ->options([
                                                'Ya' => 'Ya',
                                                'Tidak' => 'Tidak',
                                            ]),

                                        Radio::make('ps_kkm_cebok')
                                            ->label('3. Apakah ananda sudah bisa cebok sendiri?')
                                            // ->required()
                                            ->default('Ya')
                                            ->options([
                                                'Ya' => 'Ya',
                                                'Tidak' => 'Tidak',
                                            ]),

                                        Radio::make('ps_kkm_ngompol')
                                            ->label('4. Apakah ananda masih mengompol?')
                                            // ->required()
                                            ->default('Ya')
                                            ->options([
                                                'Ya' => 'Ya',
                                                'Tidak' => 'Tidak',
                                            ]),

                                        Radio::make('ps_kkm_disuapin')
                                            ->label('5. Apakah makan ananda masih disuapi?')
                                            // ->required()
                                            ->default('Ya')
                                            ->options([
                                                'Ya' => 'Ya',
                                                'Tidak' => 'Tidak',
                                            ]),

                                    ]),
                            ]),
                        // end of step 3

                        Step::make('4. KUESIONER KEMAMPUAN PEMBAYARAN ADMINISTRASI')
                            ->schema([

                                Placeholder::make('')
                                    ->content(new HtmlString('<div>
                                                    <p class="text-lg strong"><strong>KUESIONER KEMAMPUAN PEMBAYARAN ADMINISTRASI</strong></p>
                                                </div>')),

                                Placeholder::make('')
                                    ->content(new HtmlString('<div class="border-b">
                                                    <p class="text-lg strong"><strong>RINCIAN BIAYA AWAL DAN SPP</strong></p>
                                                </div>')),
                                Group::make()
                                    ->relationship('pendaftar')
                                    ->schema([
                                        Placeholder::make('')
                                            ->content(new HtmlString(
                                                '<div class="grid grid-cols-1 justify-center">

                                            <div class="border rounded-xl p-4">
                                            <table>
                                                <!-- head -->
                                                <thead>
                                                    <tr class="border-b">
                                                        <th class="text-lg text-tsn-header" colspan="4">QISM PRA TAHFIDZ-FULLDAY (tanpa makan)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                            <!-- row 1 -->
                                            <tr>
                                                <th class="text-start">Uang Pendaftaran     </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">100.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 2 -->
                                            <tr>
                                                <th class="text-start">Uang Gedung      </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">300.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 3 -->
                                            <tr>
                                                <th class="text-start">Uang Sarpras     </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">200.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 4 -->
                                            <tr class="border-tsn-header">
                                                <th class="text-start">SPP*     </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">200.000</td>
                                                <td class="text-end">(per bulan)</td>
                                            </tr>
                                            <tr class="border-t">
                                                <th>Total       </th>
                                                <td class="text-end"><strong>Rp.</strong></td>
                                                <td class="text-end"><strong>800.000</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm" colspan="4">*Pembayaran administrasi awal termasuk SPP bulan pertama</td>
                                            </tr>
                                            </tbody>
                                                </table>
                                            </div>

                                            <br>

                                            <div class="border rounded-xl p-4">
                                            <table>
                                                <!-- head -->
                                                <thead>
                                                    <tr class="border-b">
                                                        <th class="text-lg text-tsn-header" colspan="4">QISM PRA TAHFIDZ-FULLDAY (dengan makan)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                            <!-- row 1 -->
                                            <tr>
                                                <th class="text-start">Uang Pendaftaran     </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">100.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 2 -->
                                            <tr>
                                                <th class="text-start">Uang Gedung      </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">300.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 3 -->
                                            <tr>
                                                <th class="text-start">Uang Sarpras     </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">200.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 4 -->
                                            <tr class="border-tsn-header">
                                                <th class="text-start">SPP*     </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">300.000</td>
                                                <td class="text-end">(per bulan)</td>
                                            </tr>
                                            <tr class="border-t">
                                                <th>Total       </th>
                                                <td class="text-end"><strong>Rp.</strong></td>
                                                <td class="text-end"><strong>900.000</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm" colspan="4">*Pembayaran administrasi awal termasuk SPP bulan pertama</td>
                                            </tr>
                                            </tbody>
                                                </table>
                                            </div>
                                            </div>

                                            <br>

                                            <div class="border rounded-xl p-4">
                                            <table>
                                                <!-- head -->
                                                <thead>
                                                    <tr class="border-b">
                                                        <th class="text-lg text-tsn-header" colspan="4">QISM PT (menginap), TQ, IDD, MTW, TN</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                            <!-- row 1 -->
                                            <tr>
                                                <th class="text-start">Uang Pendaftaran     </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">100.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 2 -->
                                            <tr>
                                                <th class="text-start">Uang Gedung      </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">300.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 3 -->
                                            <tr>
                                                <th class="text-start">Uang Sarpras     </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">200.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 4 -->
                                            <tr class="border-tsn-header">
                                                <th class="text-start">SPP*     </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">550.000</td>
                                                <td class="text-end">(per bulan)</td>
                                            </tr>
                                            <tr class="border-t">
                                                <th>Total       </th>
                                                <td class="text-end"><strong>Rp.</strong></td>
                                                <td class="text-end"><strong>1.150.000</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm" colspan="4">*Pembayaran administrasi awal termasuk SPP bulan pertama</td>
                                            </tr>
                                            </tbody>
                                                </table>
                                            </div>'
                                            )),

                                        Radio::make('ps_kadm_status')
                                            ->label('Status anak didik terkait dengan administrasi')
                                            ->required()
                                            ->default('Santri/Santriwati tidak mampu')
                                            ->options([
                                                'Santri/Santriwati mampu (tidak ada permasalahan biaya)' => 'Santri/Santriwati mampu (tidak ada permasalahan biaya)',
                                                'Santri/Santriwati tidak mampu' => 'Santri/Santriwati tidak mampu',
                                            ])
                                            ->live(),

                                        Placeholder::make('')
                                            ->content(new HtmlString('<div class="border-b">
                                                                        <p><strong>Bersedia memenuhi persyaratan sebagai berikut:</strong></p>
                                                                    </div>'))
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('ps_kadm_status') !== 'Santri/Santriwati tidak mampu'
                                            ),

                                        Radio::make('ps_kadm_surat_subsidi')
                                            ->label('1. Wali harus membuat surat permohonan subsidi/ keringanan biaya administrasi')
                                            ->required()
                                            ->default('Bersedia')
                                            ->options([
                                                'Bersedia' => 'Bersedia',
                                                'Tidak bersedia' => 'Tidak bersedia',
                                            ])
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('ps_kadm_status') !== 'Santri/Santriwati tidak mampu'
                                            ),

                                        Radio::make('ps_kadm_surat_kurang_mampu')
                                            ->label('2. Wali harus menyertakan surat keterangan kurang mampu dari ustadz salafy setempat SERTA dari aparat pemerintah setempat, yang isinya menyatakan bhw mmg kluarga tersebut "perlu dibantu"')
                                            ->required()
                                            ->default('Bersedia')
                                            ->options([
                                                'Bersedia' => 'Bersedia',
                                                'Tidak bersedia' => 'Tidak bersedia',
                                            ])
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('ps_kadm_status') !== 'Santri/Santriwati tidak mampu'
                                            ),

                                        Radio::make('ps_kadm_atur_keuangan')
                                            ->label('3. Keuangan ananda akan dipegang dan diatur oleh Mahad')
                                            ->required()
                                            ->default('Bersedia')
                                            ->options([
                                                'Bersedia' => 'Bersedia',
                                                'Tidak bersedia' => 'Tidak bersedia',
                                            ])
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('ps_kadm_status') !== 'Santri/Santriwati tidak mampu'
                                            ),

                                        Radio::make('ps_kadm_penentuan_subsidi')
                                            ->label('4. Yang menentukan bentuk keringanan yang diberikan adalah Mahad')
                                            ->required()
                                            ->default('Bersedia')
                                            ->options([
                                                'Bersedia' => 'Bersedia',
                                                'Tidak bersedia' => 'Tidak bersedia',
                                            ])
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('ps_kadm_status') !== 'Santri/Santriwati tidak mampu'
                                            ),

                                        Radio::make('ps_kadm_hidup_sederhana')
                                            ->label('5. Ananda harus berpola hidup sederhana agar tidak menimbulkan pertanyaan pihak luar')
                                            ->required()
                                            ->default('Bersedia')
                                            ->options([
                                                'Bersedia' => 'Bersedia',
                                                'Tidak bersedia' => 'Tidak bersedia',
                                            ])
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('ps_kadm_status') !== 'Santri/Santriwati tidak mampu'
                                            ),

                                        Radio::make('ps_kadm_kebijakan_subsidi')
                                            ->label('6. Kebijakan subsidi bisa berubah sewaktu waktu')
                                            ->required()
                                            ->default('Bersedia')
                                            ->options([
                                                'Bersedia' => 'Bersedia',
                                                'Tidak bersedia' => 'Tidak bersedia',
                                            ])
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('ps_kadm_status') !== 'Santri/Santriwati tidak mampu'
                                            ),
                                    ]),
                            ]),
                        // end of step 4
                    ])
                    ->after(function ($record) {
                        Notification::make()
                            ->success()
                            ->title('Alhamdulillah ananda telah didaftarkan untuk naik qism')
                            ->body('Keluar jika telah selesai')
                            ->persistent()
                            ->color('success')
                            ->send();

                        $walisantri = Santri::find($record->id);
                        $walisantri->daftarnaikqism = 'Mendaftar';
                        $walisantri->qism_tujuan = $record->qism;
                        $walisantri->qism_detail_tujuan = $record->qism_detail;
                        $walisantri->save();
                    })
                    ->hidden(function (Santri $record) {
                        //     // dd($record->is_collapse);
                        if ($record->daftarnaikqism === 'Mendaftar') {
                            return true;
                        } elseif ($record->daftarnaikqism !== 'Mendaftar') {
                            return false;
                        }
                    }),

                Tables\Actions\ViewAction::make()
                    ->label('Lihat Data Santri')
                    ->modalHeading('Lihat Data Santri')
                    ->modalDescription(new HtmlString('<div class="">
                                                            <p>Butuh bantuan?</p>
                                                            <p>Silakan mengubungi admin di bawah ini:</p>

                                                            <table class="table w-fit">
                                        <!-- head -->
                                        <thead>
                                            <tr class="border-tsn-header">
                                                <th class="text-tsn-header text-xs" colspan="2"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- row 1 -->
                                            <tr>
                                                <th><a href="https://wa.me/6282210862400"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                                                </svg>
                                                </a></th>
                                                <td class="text-xs"><a href="https://wa.me/6282210862400">WA Admin Putra (Abu Hammaam)</a></td>
                                            </tr>
                                            <tr>
                                                <th><a href="https://wa.me/6285236459012"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"  fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                                                </svg>
                                                </a></th>
                                                <td class="text-xs"><a href="https://wa.me/6285236459012">WA Admin Putra (Abu Fathimah Hendi)</a></td>
                                            </tr>
                                            <tr>
                                                <th><a href="https://wa.me/6281333838691"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"  fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                                                </svg>
                                                </a></th>
                                                <td class="text-xs"><a href="https://wa.me/6281333838691">WA Admin Putra (Akh Irfan)</a></td>
                                            </tr>
                                            <tr>
                                                <th><a href="https://wa.me/628175765767"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"  fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                                                </svg>
                                                </a></th>
                                                <td class="text-xs"><a href="https://wa.me/628175765767">WA Admin Putri</a></td>
                                            </tr>


                                        </tbody>
                                        </table>

                                                        </div>'))
                    ->modalWidth('full')
                    // ->stickyModalHeader()
                    ->button()
                    ->closeModalByClickingAway(false)
                    ->modalCancelAction(fn (StaticAction $action) => $action->label('Tutup'))
                    ->form([

                        Section::make('1. DAFTAR NAIK QISM')
                            ->collapsible()
                            ->schema([

                                Placeholder::make('')
                                    ->content(new HtmlString('<div class="border-b">
                                                    <p class="text-lg strong"><strong>SANTRI</strong></p>
                                                </div>')),

                                TextInput::make('nama_lengkap')
                                    ->label('Nama Lengkap')
                                    ->disabled()
                                    ->required(),

                                TextInput::make('nik')
                                    ->label('NIK Santri')
                                    ->length(16)
                                    ->disabled()
                                    ->required(),

                                TextInput::make('kartu_keluarga')
                                    ->label('Nomor KK')
                                    ->length(16)
                                    ->disabled(),

                                TextInput::make('nama_kpl_kel')
                                    ->label('Nama Kepala Keluarga')
                                    ->required()
                                    ->disabled(),

                                Placeholder::make('')
                                    ->content(new HtmlString('<div class="border-b">
                                                    <p class="text-lg strong"><strong>QISM SAAT INI</strong></p>
                                                </div>')),

                                Group::make()
                                    ->relationship('kelassantri')
                                    ->schema([
                                        Hidden::make('mahad_id')
                                            ->default(1),

                                        Select::make('qism_id')
                                            ->label('Qism saat ini')
                                            ->placeholder('Pilih Qism yang dituju')
                                            ->options(Qism::all()->pluck('qism', 'id'))
                                            ->disabled()
                                            ->live()
                                            ->required()
                                            ->native(false),

                                        Select::make('qism_detail_id')
                                            ->label('')
                                            ->options(QismDetail::all()->pluck('qism_detail', 'id'))
                                            ->disabled()
                                            ->live()
                                            ->required()
                                            ->native(false),

                                        Select::make('kelas_id')
                                            ->label('Kelas saat ini')
                                            ->disabled()
                                            ->native(false)
                                            ->options(Kelas::all()->pluck('kelas', 'id'))
                                            ->required(),
                                    ]),

                                Placeholder::make('')
                                    ->content(new HtmlString('<div class="border-b">
                                                    <p class="text-lg"><strong>DIDAFTARKAN UNTUK NAIK KE QISM</strong></p>
                                                </div>')),

                                TextInput::make('qism')
                                    ->label('Qism tujuan')
                                    ->disabled()
                                    ->required()
                                    ->live(),

                                TextInput::make('qism_detail')
                                    ->label('')
                                    ->disabled()
                                    ->required()
                                    ->live(),

                            ]),
                        // end of Section 1

                        Section::make('DATA SANTRI')
                            ->collapsible()
                            ->schema([
                                //SANTRI
                                Placeholder::make('')
                                    ->content(new HtmlString('<div class="border-b">
                                                <p class="text-2xl strong"><strong>SANTRI</strong></p>
                                            </div>')),

                                TextInput::make('nama_lengkap')
                                    ->label('Nama Lengkap')
                                    ->hint('Isi sesuai dengan KK')
                                    ->hintColor('danger')
                                    ->default('asfasdad')
                                    ->required(),

                                TextInput::make('nama_panggilan')
                                    ->label('Nama Hijroh/Islami')
                                    ->default('asfasdad')
                                    ->required(),

                                Placeholder::make('')
                                    ->content(new HtmlString('<div class="border-b">
                                            </div>')),

                                Grid::make(4)
                                    ->schema([

                                        Radio::make('jeniskelamin')
                                            ->label('Jenis Kelamin')
                                            ->options([
                                                'Laki-laki' => 'Laki-laki',
                                                'Perempuan' => 'Perempuan',
                                            ])
                                            ->required()
                                            ->default('Laki-laki')
                                            ->inline(),

                                        TextInput::make('tempat_lahir')
                                            ->label('Tempat Lahir')
                                            ->hint('Isi sesuai dengan KK')
                                            ->hintColor('danger')
                                            ->default('asfasdad')
                                            ->required(),

                                        DatePicker::make('tanggal_lahir')
                                            ->label('Tanggal Lahir')
                                            ->hint('Isi sesuai dengan KK')
                                            ->hintColor('danger')
                                            ->default('20010101')
                                            ->required()
                                            ->displayFormat('d M Y')
                                            ->native(false)
                                            ->live()
                                            ->closeOnDateSelection()
                                            ->afterStateUpdated(function (Set $set, $state) {
                                                $set('umur', Carbon::parse($state)->age);
                                            }),

                                        TextInput::make('umur')
                                            ->label('Umur')
                                            ->disabled()
                                            ->dehydrated()
                                            ->required(),

                                    ]),

                                Placeholder::make('')
                                    ->content(new HtmlString('<div class="border-b"></div>')),

                                Grid::make(2)
                                    ->schema([

                                        TextInput::make('anak_ke')
                                            ->label('Anak ke-')
                                            ->required()
                                            ->default('3')
                                            ->rules([
                                                fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {

                                                    $anakke = $get('anak_ke');
                                                    $psjumlahsaudara = $get('jumlah_saudara');
                                                    $jumlahsaudara = $psjumlahsaudara + 1;

                                                    if ($anakke > $jumlahsaudara) {
                                                        $fail("Anak ke tidak bisa lebih dari jumlah saudara + 1");
                                                    }
                                                },
                                            ]),

                                        TextInput::make('jumlah_saudara')
                                            ->label('Jumlah saudara')
                                            ->default('5')
                                            ->required(),
                                    ]),

                                Placeholder::make('')
                                    ->content(new HtmlString('<div class="border-b"></div>')),

                                Grid::make(1)
                                    ->schema([

                                        TextInput::make('agama')
                                            ->label('Agama')
                                            ->default('Islam')
                                            ->disabled()
                                            ->required()
                                            ->dehydrated(),
                                    ]),

                                Placeholder::make('')
                                    ->content(new HtmlString('<div class="border-b"></div>')),

                                Grid::make(2)
                                    ->schema([

                                        Select::make('cita_cita')
                                            ->label('Cita-cita')
                                            ->placeholder('Pilih Cita-cita')
                                            ->options([
                                                'PNS' => 'PNS',
                                                'TNI/Polri' => 'TNI/Polri',
                                                'Guru/Dosen' => 'Guru/Dosen',
                                                'Dokter' => 'Dokter',
                                                'Politikus' => 'Politikus',
                                                'Wiraswasta' => 'Wiraswasta',
                                                'Seniman/Artis' => 'Seniman/Artis',
                                                'Ilmuwan' => 'Ilmuwan',
                                                'Agamawan' => 'Agamawan',
                                                'Lainnya' => 'Lainnya',
                                            ])
                                            // ->searchable()
                                            ->required()
                                            ->default('Lainnya')
                                            ->live()
                                            ->native(false),

                                        TextInput::make('cita_cita_lainnya')
                                            ->label('Cita-cita Lainnya')
                                            ->required()
                                            ->default('asfasdad')
                                            ->hidden(fn (Get $get) =>
                                            $get('cita_cita') !== 'Lainnya'),
                                    ]),

                                Grid::make(2)
                                    ->schema([
                                        Select::make('hobi')
                                            ->label('Hobi')
                                            ->placeholder('Pilih Hobi')
                                            ->options([
                                                'Olahraga' => 'Olahraga',
                                                'Kesetuan' => 'Kesetuan',
                                                'Membaca' => 'Membaca',
                                                'Menulis' => 'Menulis',
                                                'Jalan-jalan' => 'Jalan-jalan',
                                                'Lainnya' => 'Lainnya',
                                            ])
                                            // ->searchable()
                                            ->required()
                                            ->default('Lainnya')
                                            ->live()
                                            ->native(false),

                                        TextInput::make('hobi_lainnya')
                                            ->label('Hobi Lainnya')
                                            ->required()
                                            ->default('asfasdad')
                                            ->hidden(fn (Get $get) =>
                                            $get('hobi') !== 'Lainnya'),

                                    ]),


                                Placeholder::make('')
                                    ->content(new HtmlString('<div class="border-b"></div>')),

                                Grid::make(2)
                                    ->schema([
                                        Select::make('keb_khus')
                                            ->label('Kebutuhan Khusus')
                                            ->placeholder('Pilih Kebutuhan Khusus')
                                            ->options([
                                                'Tidak Ada' => 'Tidak Ada',
                                                'Lamban belajar' => 'Lamban belajar',
                                                'Kesulitan belajar spesifik' => 'Kesulitan belajar spesifik',
                                                'Gangguan komunikasi' => 'Gangguan komunikasi',
                                                'Berbakat/memiliki kemampuan dan kecerdasan luar biasa' => 'Berbakat/memiliki kemampuan dan kecerdasan luar biasa',
                                                'Lainnya' => 'Lainnya',
                                            ])
                                            // ->searchable()
                                            ->required()
                                            ->default('Lainnya')
                                            ->live()
                                            ->native(false),

                                        TextInput::make('keb_khus_lainnya')
                                            ->label('Kebutuhan Khusus Lainnya')
                                            ->required()
                                            ->default('asfasdad')
                                            ->hidden(fn (Get $get) =>
                                            $get('keb_khus') !== 'Lainnya'),
                                    ]),

                                Grid::make(2)
                                    ->schema([
                                        Select::make('keb_dis')
                                            ->label('Kebutuhan Disabilitas')
                                            ->placeholder('Pilih Kebutuhan Disabilitas')
                                            ->options([
                                                'Tidak Ada' => 'Tidak Ada',
                                                'Tuna Netra' => 'Tuna Netra',
                                                'Tuna Rungu' => 'Tuna Rungu',
                                                'Tuna Daksa' => 'Tuna Daksa',
                                                'Tuna Grahita' => 'Tuna Grahita',
                                                'Tuna Laras' => 'Tuna Laras',
                                                'Tuna Wicara' => 'Tuna Wicara',
                                                'Lainnya' => 'Lainnya',
                                            ])
                                            // ->searchable()
                                            ->required()
                                            ->default('Lainnya')
                                            ->live()
                                            ->native(false),

                                        TextInput::make('keb_dis_lainnya')
                                            ->label('Kebutuhan Disabilitas Lainnya')
                                            ->required()
                                            ->default('asfasdad')
                                            ->hidden(fn (Get $get) =>
                                            $get('keb_dis') !== 'Lainnya'),
                                    ]),

                                Placeholder::make('')
                                    ->content(new HtmlString('<div class="border-b"></div>')),

                                Grid::make(1)
                                    ->schema([

                                        Radio::make('tdk_hp')
                                            ->label('Memiliki nomor handphone?')
                                            ->live()
                                            ->default('Ya')
                                            ->options([
                                                'Ya' => 'Ya',
                                                'Tidak' => 'Tidak',
                                            ]),

                                        TextInput::make('nomor_handphone')
                                            ->label('No. Handphone')
                                            ->helperText('Contoh: 82187782223')
                                            // ->mask('82187782223')
                                            ->prefix('62')
                                            ->tel()
                                            ->default('82187782223')
                                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                                            ->required()
                                            ->hidden(fn (Get $get) =>
                                            $get('tdk_hp') !== 'Ya'),

                                        TextInput::make('email')
                                            ->label('Email')
                                            ->default('mail@mail.com')
                                            ->email(),
                                    ]),

                                Placeholder::make('')
                                    ->content(new HtmlString('<div class="border-b"></div>')),

                                Grid::make(2)
                                    ->schema([
                                        Select::make('bya_sklh')
                                            ->label('Yang membiayai sekolah')
                                            ->placeholder('Pilih Yang membiayai sekolah')
                                            ->options([
                                                'Orang Tua' => 'Orang Tua',
                                                'Wali/Orang Tua Asuh' => 'Wali/Orang Tua Asuh',
                                                'Tanggungan Sendiri' => 'Tanggungan Sendiri',
                                                'Lainnya' => 'Lainnya',
                                            ])
                                            // ->searchable()
                                            ->required()
                                            ->default('Lainnya')
                                            ->live()
                                            ->native(false),

                                        TextInput::make('bya_sklh_lainnya')
                                            ->label('Yang membiayai sekolah lainnya')
                                            ->required()
                                            ->default('asfasdad')
                                            ->hidden(fn (Get $get) =>
                                            $get('bya_sklh') !== 'Lainnya'),
                                    ]),

                                Grid::make(2)
                                    ->schema([

                                        Radio::make('belum_nisn')
                                            ->label('Apakah memiliki NISN?')
                                            ->helperText(new HtmlString('<strong>NISN</strong> adalah Nomor Induk Siswa Nasional'))
                                            ->live()
                                            ->default('Ya')
                                            ->options([
                                                'Ya' => 'Ya',
                                                'Tidak' => 'Tidak',
                                            ]),

                                        TextInput::make('nisn')
                                            ->label('Nomor NISN')
                                            ->required()
                                            ->default('2421324')
                                            ->hidden(fn (Get $get) =>
                                            $get('belum_nisn') !== 'Ya'),
                                    ]),

                                Grid::make(2)
                                    ->schema([

                                        Radio::make('nomor_kip_memiliki')
                                            ->label('Apakah memiliki KIP?')
                                            ->helperText(new HtmlString('<strong>KIP</strong> adalah Kartu Indonesia Pintar'))
                                            ->live()
                                            ->default('Ya')
                                            ->options([
                                                'Ya' => 'Ya',
                                                'Tidak' => 'Tidak',
                                            ]),

                                        TextInput::make('nomor_kip')
                                            ->label('Nomor KIP')
                                            ->required()
                                            ->default('32524324')
                                            ->hidden(fn (Get $get) =>
                                            $get('nomor_kip_memiliki') !== 'Ya'),
                                    ]),

                                Placeholder::make('')
                                    ->content(new HtmlString('<div class="border-b"></div>')),

                                TextInput::make('aktivitaspend')
                                    ->label('Aktivitas Pendidikan yang Diikuti')
                                    ->placeholder('Pilih Aktivitas Pendidikan yang Diikuti')
                                    ->default('PKPPS')
                                    ->hidden()
                                    ->dehydrated(),

                                Group::make()
                                    ->relationship('pendaftar')
                                    ->schema([

                                        Grid::make(2)
                                            ->schema([

                                                Select::make('ps_mendaftar_keinginan')
                                                    ->label('Mendaftar atas kenginginan')
                                                    ->options([
                                                        'Orangtua' => 'Orangtua',
                                                        'Ananda' => 'Ananda',
                                                        'Lainnya' => 'Lainnya',
                                                    ])
                                                    ->required()
                                                    ->live()
                                                    ->default('Lainnya')
                                                    ->native(false),

                                                TextInput::make('ps_mendaftar_keinginan_lainnya')
                                                    ->label('Lainnya')
                                                    ->required()
                                                    ->default('asdasf')
                                                    ->hidden(fn (Get $get) =>
                                                    $get('ps_mendaftar_keinginan') !== 'Lainnya'),
                                            ]),

                                        Placeholder::make('')
                                            ->content(new HtmlString('<div class="border-b"></div>')),

                                        Textarea::make('ps_peng_pend_agama')
                                            ->label('Pengalaman pendidikan agama')
                                            ->required()
                                            ->default('asdasf'),

                                        Textarea::make('ps_peng_pend_formal')
                                            ->label('Pengalaman pendidikan formal')
                                            ->required()
                                            ->default('asdasf'),

                                        TextInput::make('ps_hafalan')
                                            ->label('Hafalan')
                                            ->length('2')
                                            ->suffix('juz')
                                            ->required()
                                            ->default('10'),
                                    ]),

                                Placeholder::make('')
                                    ->content(new HtmlString('<div class="border-b"></div>')),

                                // ALAMAT SANTRI
                                Placeholder::make('')
                                    ->content(new HtmlString('<div class="border-b">
                                                <p class="text-lg strong"><strong>TEMPAT TINGGAL DOMISILI</strong></p>
                                                <p class="text-lg strong"><strong>SANTRI</strong></p>
                                            </div>')),

                                Radio::make('al_s_status_mukim')
                                    ->label('Apakah mukim di Pondok?')
                                    ->helperText(new HtmlString('Pilih <strong>Tidak Mukim</strong> khusus bagi pendaftar <strong>Tarbiyatul Aulaad</strong> dan <strong>Pra Tahfidz kelas 1-4</strong>'))
                                    ->live()
                                    ->default('Tidak Mukim')
                                    ->options([
                                        'Mukim' => 'Mukim',
                                        'Tidak Mukim' => 'Tidak Mukim',
                                    ])
                                    ->afterStateUpdated(function (Get $get, Set $set) {
                                        if ($get('al_s_status_mukim') === 'Mukim') {

                                            $set('al_s_stts_tptgl', 'Tinggal di Asrama Pesantren');
                                        } elseif ($get('al_s_status_mukim') === 'Tidak Mukim') {

                                            $set('al_s_stts_tptgl', null);
                                        }
                                    }),

                                Select::make('al_s_stts_tptgl')
                                    ->label('Status tempat tinggal')
                                    ->placeholder('Status tempat tinggal')
                                    ->options(function (Get $get) {
                                        if ($get('al_s_status_mukim') === 'Tidak Mukim') {
                                            return ([
                                                'Tinggal dengan Ayah Kandung' => 'Tinggal dengan Ayah Kandung',
                                                'Tinggal dengan Ibu Kandung' => 'Tinggal dengan Ibu Kandung',
                                                'Tinggal dengan Wali' => 'Tinggal dengan Wali',
                                                'Ikut Saudara/Kerabat' => 'Ikut Saudara/Kerabat',
                                                'Kontrak/Kost' => 'Kontrak/Kost',
                                                'Tinggal di Asrama Bukan Milik Pesantren' => 'Tinggal di Asrama Bukan Milik Pesantren',
                                                'Panti Asuhan' => 'Panti Asuhan',
                                                'Rumah Singgah' => 'Rumah Singgah',
                                                'Lainnya' => 'Lainnya',
                                            ]);
                                        } elseif ($get('al_s_status_mukim') === 'Mukim') {
                                            return ([
                                                'Tinggal di Asrama Pesantren' => 'Tinggal di Asrama Pesantren'
                                            ]);
                                        }
                                    })
                                    // ->searchable()
                                    ->required()
                                    ->default('Kontrak/Kost')
                                    ->disabled(fn (Get $get) =>
                                    $get('al_s_status_mukim') === 'Mukim')
                                    ->live()
                                    ->native(false)
                                    ->dehydrated(),

                                Grid::make(2)
                                    ->schema([

                                        Select::make('al_s_provinsi_id')
                                            ->label('Provinsi')
                                            ->placeholder('Pilih Provinsi')
                                            ->options(Provinsi::all()->pluck('provinsi', 'id'))
                                            ->searchable()
                                            ->default('35')
                                            ->required()
                                            ->live()
                                            ->native(false)
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('al_s_status_mukim') !== 'Tidak Mukim' ||
                                                    $get('al_s_stts_tptgl') === 'Tinggal dengan Ayah Kandung' ||
                                                    $get('al_s_stts_tptgl') === 'Tinggal dengan Ibu Kandung' ||
                                                    $get('al_s_stts_tptgl') === 'Tinggal dengan Wali' ||
                                                    $get('al_s_stts_tptgl') === null
                                            )
                                            ->afterStateUpdated(function (Set $set) {
                                                $set('al_s_kabupaten_id', null);
                                                $set('al_s_kecamatan_id', null);
                                                $set('al_s_kelurahan_id', null);
                                                $set('al_s_kodepos', null);
                                            }),

                                        Select::make('al_s_kabupaten_id')
                                            ->label('Kabupaten')
                                            ->placeholder('Pilih Kabupaten')
                                            ->options(fn (Get $get): Collection => Kabupaten::query()
                                                ->where('provinsi_id', $get('al_s_provinsi_id'))
                                                ->pluck('kabupaten', 'id'))
                                            ->searchable()
                                            ->required()
                                            ->default('232')
                                            ->live()
                                            ->native(false)
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('al_s_status_mukim') !== 'Tidak Mukim' ||
                                                    $get('al_s_stts_tptgl') === 'Tinggal dengan Ayah Kandung' ||
                                                    $get('al_s_stts_tptgl') === 'Tinggal dengan Ibu Kandung' ||
                                                    $get('al_s_stts_tptgl') === 'Tinggal dengan Wali' ||
                                                    $get('al_s_stts_tptgl') === null
                                            ),

                                        Select::make('al_s_kecamatan_id')
                                            ->label('Kecamatan')
                                            ->placeholder('Pilih Kecamatan')
                                            ->options(fn (Get $get): Collection => Kecamatan::query()
                                                ->where('kabupaten_id', $get('al_s_kabupaten_id'))
                                                ->pluck('kecamatan', 'id'))
                                            ->searchable()
                                            ->required()
                                            ->default('3617')
                                            ->live()
                                            ->native(false)
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('al_s_status_mukim') !== 'Tidak Mukim' ||
                                                    $get('al_s_stts_tptgl') === 'Tinggal dengan Ayah Kandung' ||
                                                    $get('al_s_stts_tptgl') === 'Tinggal dengan Ibu Kandung' ||
                                                    $get('al_s_stts_tptgl') === 'Tinggal dengan Wali' ||
                                                    $get('al_s_stts_tptgl') === null
                                            ),

                                        Select::make('al_s_kelurahan_id')
                                            ->label('Kelurahan')
                                            ->placeholder('Pilih Kelurahan')
                                            ->options(fn (Get $get): Collection => Kelurahan::query()
                                                ->where('kecamatan_id', $get('al_s_kecamatan_id'))
                                                ->pluck('kelurahan', 'id'))
                                            ->searchable()
                                            ->required()
                                            ->default('45322')
                                            ->live()
                                            ->native(false)
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('al_s_status_mukim') !== 'Tidak Mukim' ||
                                                    $get('al_s_stts_tptgl') === 'Tinggal dengan Ayah Kandung' ||
                                                    $get('al_s_stts_tptgl') === 'Tinggal dengan Ibu Kandung' ||
                                                    $get('al_s_stts_tptgl') === 'Tinggal dengan Wali' ||
                                                    $get('al_s_stts_tptgl') === null
                                            )
                                            ->afterStateUpdated(function (Get $get, ?string $state, Set $set, ?string $old) {

                                                $kodepos = Kodepos::where('kelurahan_id', $state)->get('kodepos');

                                                $state = $kodepos;

                                                foreach ($state as $state) {
                                                    $set('al_s_kodepos', Str::substr($state, 12, 5));
                                                }
                                            }),


                                        TextInput::make('al_s_rt')
                                            ->label('RT')
                                            ->required()
                                            ->default('2')
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('al_s_status_mukim') !== 'Tidak Mukim' ||
                                                    $get('al_s_stts_tptgl') === 'Tinggal dengan Ayah Kandung' ||
                                                    $get('al_s_stts_tptgl') === 'Tinggal dengan Ibu Kandung' ||
                                                    $get('al_s_stts_tptgl') === 'Tinggal dengan Wali' ||
                                                    $get('al_s_stts_tptgl') === null
                                            ),

                                        TextInput::make('al_s_rw')
                                            ->label('RW')
                                            ->required()
                                            ->default('2')
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('al_s_status_mukim') !== 'Tidak Mukim' ||
                                                    $get('al_s_stts_tptgl') === 'Tinggal dengan Ayah Kandung' ||
                                                    $get('al_s_stts_tptgl') === 'Tinggal dengan Ibu Kandung' ||
                                                    $get('al_s_stts_tptgl') === 'Tinggal dengan Wali' ||
                                                    $get('al_s_stts_tptgl') === null
                                            ),

                                        Textarea::make('al_s_alamat')
                                            ->label('Alamat')
                                            ->required()
                                            ->columnSpanFull()
                                            ->default('sdfsdasdada')
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('al_s_status_mukim') !== 'Tidak Mukim' ||
                                                    $get('al_s_stts_tptgl') === 'Tinggal dengan Ayah Kandung' ||
                                                    $get('al_s_stts_tptgl') === 'Tinggal dengan Ibu Kandung' ||
                                                    $get('al_s_stts_tptgl') === 'Tinggal dengan Wali' ||
                                                    $get('al_s_stts_tptgl') === null
                                            ),

                                        TextInput::make('al_s_kodepos')
                                            ->label('Kodepos')
                                            ->disabled()
                                            ->required()
                                            ->dehydrated()
                                            ->default('63264')
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('al_s_status_mukim') !== 'Tidak Mukim' ||
                                                    $get('al_s_stts_tptgl') === 'Tinggal dengan Ayah Kandung' ||
                                                    $get('al_s_stts_tptgl') === 'Tinggal dengan Ibu Kandung' ||
                                                    $get('al_s_stts_tptgl') === 'Tinggal dengan Wali' ||
                                                    $get('al_s_stts_tptgl') === null
                                            ),


                                        Grid::make(3)
                                            ->schema([
                                                Select::make('al_s_jarak')
                                                    ->label('Jarak tempat tinggal ke Pondok Pesantren')
                                                    ->options([
                                                        'Kurang dari 5 km' => 'Kurang dari 5 km',
                                                        'Antara 5 - 10 Km' => 'Antara 5 - 10 Km',
                                                        'Antara 11 - 20 Km' => 'Antara 11 - 20 Km',
                                                        'Antara 21 - 30 Km' => 'Antara 21 - 30 Km',
                                                        'Lebih dari 30 Km' => 'Lebih dari 30 Km',
                                                    ])
                                                    // ->searchable()
                                                    ->required()
                                                    ->default('Kurang dari 5 km')
                                                    ->live()
                                                    ->native(false)
                                                    ->hidden(
                                                        fn (Get $get) =>
                                                        $get('al_s_status_mukim') !== 'Tidak Mukim' ||
                                                            $get('al_s_stts_tptgl') === null
                                                    ),

                                                Select::make('al_s_transportasi')
                                                    ->label('Transportasi ke Pondok Pesantren')
                                                    ->options([
                                                        'Jalan kaki' => 'Jalan kaki',
                                                        'Sepeda' => 'Sepeda',
                                                        'Sepeda Motor' => 'Sepeda Motor',
                                                        'Mobil Pribadi' => 'Mobil Pribadi',
                                                        'Antar Jemput Sekolah' => 'Antar Jemput Sekolah',
                                                        'Angkutan Umum' => 'Angkutan Umum',
                                                        'Perahu/Sampan' => 'Perahu/Sampan',
                                                        'Lainnya' => 'Lainnya',
                                                        'Kendaraan Pribadi' => 'Kendaraan Pribadi',
                                                        'Kereta Api' => 'Kereta Api',
                                                        'Ojek' => 'Ojek',
                                                        'Andong/Bendi/Sado/Dokar/Delman/Becak' => 'Andong/Bendi/Sado/Dokar/Delman/Becak',
                                                    ])
                                                    // ->searchable()
                                                    ->required()
                                                    ->default('Ojek')
                                                    ->live()
                                                    ->native(false)
                                                    ->hidden(
                                                        fn (Get $get) =>
                                                        $get('al_s_status_mukim') !== 'Tidak Mukim' ||
                                                            $get('al_s_stts_tptgl') === null
                                                    ),

                                                Select::make('al_s_waktu_tempuh')
                                                    ->label('Waktu tempuh ke Pondok Pesantren')
                                                    ->options([
                                                        '1 - 10 menit' => '1 - 10 menit',
                                                        '10 - 19 menit' => '10 - 19 menit',
                                                        '20 - 29 menit' => '20 - 29 menit',
                                                        '30 - 39 menit' => '30 - 39 menit',
                                                        '1 - 2 jam' => '1 - 2 jam',
                                                        '> 2 jam' => '> 2 jam',
                                                    ])
                                                    // ->searchable()
                                                    ->required()
                                                    ->default('10 - 19 menit')
                                                    ->live()
                                                    ->native(false)
                                                    ->hidden(
                                                        fn (Get $get) =>
                                                        $get('al_s_status_mukim') !== 'Tidak Mukim' ||
                                                            $get('al_s_stts_tptgl') === null
                                                    ),

                                                TextInput::make('al_s_koordinat')
                                                    ->label('Titik koordinat tempat tinggal')
                                                    ->default('sfasdadasdads')
                                                    ->hidden(
                                                        fn (Get $get) =>
                                                        $get('al_s_status_mukim') !== 'Tidak Mukim' ||
                                                            $get('al_s_stts_tptgl') === null
                                                    )->columnSpanFull(),
                                            ]),
                                    ]),
                            ]),
                        // end of Section

                        Section::make('2. KUESIONER KESEHATAN')
                            ->collapsible()
                            ->schema([

                                Placeholder::make('')
                                    ->content(new HtmlString('<div class="border-b">
                                                    <p class="text-lg strong"><strong>KUESIONER KESEHATAN</strong></p>
                                                </div>')),
                                Group::make()
                                    ->relationship('pendaftar')
                                    ->schema([
                                        Radio::make('ps_kkes_sakit_serius')
                                            ->label('1. Apakah ananda pernah mengalami sakit yang cukup serius?')
                                            ->required()
                                            ->default('Ya')
                                            ->options([
                                                'Ya' => 'Ya',
                                                'Tidak' => 'Tidak',
                                            ])
                                            ->live(),

                                        TextArea::make('ps_kkes_sakit_serius_nama_penyakit')
                                            ->label('Jika iya, kapan dan penyakit apa?')
                                            ->required()
                                            ->default('asdad')
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('ps_kkes_sakit_serius') !== 'Ya'
                                            ),

                                        Radio::make('ps_kkes_terapi')
                                            ->label('2. Apakah ananda pernah atau sedang menjalani terapi kesehatan?')
                                            ->required()
                                            ->default('Ya')
                                            ->options([
                                                'Ya' => 'Ya',
                                                'Tidak' => 'Tidak',
                                            ])
                                            ->live(),

                                        TextArea::make('ps_kkes_terapi_nama_terapi')
                                            ->label('Jika iya, kapan dan terapi apa?')
                                            ->required()
                                            ->default('asdasd')
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('ps_kkes_terapi') !== 'Ya'
                                            ),

                                        Radio::make('ps_kkes_kambuh')
                                            ->label('3. Apakah ananda memiliki penyakit yang dapat/sering kambuh?')
                                            ->required()
                                            ->default('Ya')
                                            ->options([
                                                'Ya' => 'Ya',
                                                'Tidak' => 'Tidak',
                                            ])
                                            ->live(),

                                        TextArea::make('ps_kkes_kambuh_nama_penyakit')
                                            ->label('Jika iya, penyakit apa?')
                                            ->required()
                                            ->default('asdad')
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('ps_kkes_kambuh') !== 'Ya'
                                            ),

                                        Radio::make('ps_kkes_alergi')
                                            ->label('4. Apakah ananda memiliki alergi terhadap perkara-perkara tertentu?')
                                            ->required()
                                            ->default('Ya')
                                            ->options([
                                                'Ya' => 'Ya',
                                                'Tidak' => 'Tidak',
                                            ])
                                            ->live(),

                                        TextArea::make('ps_kkes_alergi_nama_alergi')
                                            ->label('Jika iya, sebutkan!')
                                            ->required()
                                            ->default('asdadsd')
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('ps_kkes_alergi') !== 'Ya'
                                            ),

                                        Radio::make('ps_kkes_pantangan')
                                            ->label('5. Apakah ananda mempunyai pantangan yang berkaitan dengan kesehatan?')
                                            ->required()
                                            ->default('Ya')
                                            ->options([
                                                'Ya' => 'Ya',
                                                'Tidak' => 'Tidak',
                                            ])
                                            ->live(),

                                        TextArea::make('ps_kkes_pantangan_nama')
                                            ->label('Jika iya, sebutkan dan jelaskan alasannya!')
                                            ->required()
                                            ->default('asdadssad')
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('ps_kkes_pantangan') !== 'Ya'
                                            ),

                                        Radio::make('ps_kkes_psikologis')
                                            ->label('6. Apakah ananda pernah mengalami gangguan psikologis (depresi dan gejala-gejalanya)?')
                                            ->required()
                                            ->default('Ya')
                                            ->options([
                                                'Ya' => 'Ya',
                                                'Tidak' => 'Tidak',
                                            ])
                                            ->live(),

                                        TextArea::make('ps_kkes_psikologis_kapan')
                                            ->label('Jika iya, kapan?')
                                            ->required()
                                            ->default('asdad')
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('ps_kkes_psikologis') !== 'Ya'
                                            ),

                                        Radio::make('ps_kkes_gangguan')
                                            ->label('7. Apakah ananda pernah mengalami gangguan jin?')
                                            ->required()
                                            ->default('Ya')
                                            ->options([
                                                'Ya' => 'Ya',
                                                'Tidak' => 'Tidak',
                                            ])
                                            ->live(),

                                        TextArea::make('ps_kkes_gangguan_kapan')
                                            ->label('Jika iya, kapan?')
                                            ->required()
                                            ->default('asdadsad')
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('ps_kkes_gangguan') !== 'Ya'
                                            ),

                                    ]),
                            ]),
                        // end of Section 2

                        Section::make('3. KUESIONER KEMANDIRIAN')
                            ->collapsible()
                            ->schema([

                                Placeholder::make('')
                                    ->content(new HtmlString('<div class="border-b">
                                                    <p class="text-lg"><strong>KUESIONER KEMANDIRIAN</strong></p>
                                                    <br>
                                                    <p class="text-sm"><strong>Kuesioner ini khusus untuk calon santri Pra Tahfidz kelas 1-4</strong></p>
                                                </div>')),
                                Group::make()
                                    ->relationship('pendaftar')
                                    ->schema([
                                        Radio::make('ps_kkm_bak')
                                            ->label('1. Apakah ananda sudah bisa BAK sendiri?')
                                            ->required()
                                            ->default('Ya')
                                            ->options([
                                                'Ya' => 'Ya',
                                                'Tidak' => 'Tidak',
                                            ]),

                                        Radio::make('ps_kkm_bab')
                                            ->label('2. Apakah ananda sudah bisa BAB sendiri?')
                                            ->required()
                                            ->default('Ya')
                                            ->options([
                                                'Ya' => 'Ya',
                                                'Tidak' => 'Tidak',
                                            ]),

                                        Radio::make('ps_kkm_cebok')
                                            ->label('3. Apakah ananda sudah bisa cebok sendiri?')
                                            ->required()
                                            ->default('Ya')
                                            ->options([
                                                'Ya' => 'Ya',
                                                'Tidak' => 'Tidak',
                                            ]),

                                        Radio::make('ps_kkm_ngompol')
                                            ->label('4. Apakah ananda masih mengompol?')
                                            ->required()
                                            ->default('Ya')
                                            ->options([
                                                'Ya' => 'Ya',
                                                'Tidak' => 'Tidak',
                                            ]),

                                        Radio::make('ps_kkm_disuapin')
                                            ->label('5. Apakah makan ananda masih disuapi?')
                                            ->required()
                                            ->default('Ya')
                                            ->options([
                                                'Ya' => 'Ya',
                                                'Tidak' => 'Tidak',
                                            ]),

                                    ]),
                            ]),
                        // end of Section 3

                        Section::make('4. KUESIONER KEMAMPUAN PEMBAYARAN ADMINISTRASI')
                            ->collapsible()
                            ->schema([

                                Placeholder::make('')
                                    ->content(new HtmlString('<div>
                                                    <p class="text-lg strong"><strong>KUESIONER KEMAMPUAN PEMBAYARAN ADMINISTRASI</strong></p>
                                                </div>')),

                                Placeholder::make('')
                                    ->content(new HtmlString('<div class="border-b">
                                                    <p class="text-lg strong"><strong>RINCIAN BIAYA AWAL DAN SPP</strong></p>
                                                </div>')),
                                Group::make()
                                    ->relationship('pendaftar')
                                    ->schema([
                                        Placeholder::make('')
                                            ->content(new HtmlString(
                                                '<div class="grid grid-cols-1 justify-center">

                                            <div class="border rounded-xl p-4">
                                            <table>
                                                <!-- head -->
                                                <thead>
                                                    <tr class="border-b">
                                                        <th class="text-lg text-tsn-header" colspan="4">QISM PRA TAHFIDZ-FULLDAY (tanpa makan)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                            <!-- row 1 -->
                                            <tr>
                                                <th class="text-start">Uang Pendaftaran     </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">100.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 2 -->
                                            <tr>
                                                <th class="text-start">Uang Gedung      </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">300.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 3 -->
                                            <tr>
                                                <th class="text-start">Uang Sarpras     </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">200.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 4 -->
                                            <tr class="border-tsn-header">
                                                <th class="text-start">SPP*     </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">200.000</td>
                                                <td class="text-end">(per bulan)</td>
                                            </tr>
                                            <tr class="border-t">
                                                <th>Total       </th>
                                                <td class="text-end"><strong>Rp.</strong></td>
                                                <td class="text-end"><strong>800.000</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm" colspan="4">*Pembayaran administrasi awal termasuk SPP bulan pertama</td>
                                            </tr>
                                            </tbody>
                                                </table>
                                            </div>

                                            <br>

                                            <div class="border rounded-xl p-4">
                                            <table>
                                                <!-- head -->
                                                <thead>
                                                    <tr class="border-b">
                                                        <th class="text-lg text-tsn-header" colspan="4">QISM PRA TAHFIDZ-FULLDAY (dengan makan)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                            <!-- row 1 -->
                                            <tr>
                                                <th class="text-start">Uang Pendaftaran     </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">100.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 2 -->
                                            <tr>
                                                <th class="text-start">Uang Gedung      </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">300.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 3 -->
                                            <tr>
                                                <th class="text-start">Uang Sarpras     </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">200.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 4 -->
                                            <tr class="border-tsn-header">
                                                <th class="text-start">SPP*     </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">300.000</td>
                                                <td class="text-end">(per bulan)</td>
                                            </tr>
                                            <tr class="border-t">
                                                <th>Total       </th>
                                                <td class="text-end"><strong>Rp.</strong></td>
                                                <td class="text-end"><strong>900.000</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm" colspan="4">*Pembayaran administrasi awal termasuk SPP bulan pertama</td>
                                            </tr>
                                            </tbody>
                                                </table>
                                            </div>
                                            </div>

                                            <br>

                                            <div class="border rounded-xl p-4">
                                            <table>
                                                <!-- head -->
                                                <thead>
                                                    <tr class="border-b">
                                                        <th class="text-lg text-tsn-header" colspan="4">QISM PT (menginap), TQ, IDD, MTW, TN</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                            <!-- row 1 -->
                                            <tr>
                                                <th class="text-start">Uang Pendaftaran     </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">100.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 2 -->
                                            <tr>
                                                <th class="text-start">Uang Gedung      </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">300.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 3 -->
                                            <tr>
                                                <th class="text-start">Uang Sarpras     </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">200.000</td>
                                                <td class="text-end">(per tahun)</td>
                                            </tr>
                                            <!-- row 4 -->
                                            <tr class="border-tsn-header">
                                                <th class="text-start">SPP*     </th>
                                                <td class="text-end">Rp.</td>
                                                <td class="text-end">550.000</td>
                                                <td class="text-end">(per bulan)</td>
                                            </tr>
                                            <tr class="border-t">
                                                <th>Total       </th>
                                                <td class="text-end"><strong>Rp.</strong></td>
                                                <td class="text-end"><strong>1.150.000</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm" colspan="4">*Pembayaran administrasi awal termasuk SPP bulan pertama</td>
                                            </tr>
                                            </tbody>
                                                </table>
                                            </div>'
                                            )),

                                        Radio::make('ps_kadm_status')
                                            ->label('Status anak didik terkait dengan administrasi')
                                            ->required()
                                            ->default('Santri/Santriwati tidak mampu')
                                            ->options([
                                                'Santri/Santriwati mampu (tidak ada permasalahan biaya)' => 'Santri/Santriwati mampu (tidak ada permasalahan biaya)',
                                                'Santri/Santriwati tidak mampu' => 'Santri/Santriwati tidak mampu',
                                            ])
                                            ->live(),

                                        Placeholder::make('')
                                            ->content(new HtmlString('<div class="border-b">
                                                                        <p><strong>Bersedia memenuhi persyaratan sebagai berikut:</strong></p>
                                                                    </div>'))
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('ps_kadm_status') !== 'Santri/Santriwati tidak mampu'
                                            ),

                                        Radio::make('ps_kadm_surat_subsidi')
                                            ->label('1. Wali harus membuat surat permohonan subsidi/ keringanan biaya administrasi')
                                            ->required()
                                            ->default('Bersedia')
                                            ->options([
                                                'Bersedia' => 'Bersedia',
                                                'Tidak bersedia' => 'Tidak bersedia',
                                            ])
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('ps_kadm_status') !== 'Santri/Santriwati tidak mampu'
                                            ),

                                        Radio::make('ps_kadm_surat_kurang_mampu')
                                            ->label('2. Wali harus menyertakan surat keterangan kurang mampu dari ustadz salafy setempat SERTA dari aparat pemerintah setempat, yang isinya menyatakan bhw mmg kluarga tersebut "perlu dibantu"')
                                            ->required()
                                            ->default('Bersedia')
                                            ->options([
                                                'Bersedia' => 'Bersedia',
                                                'Tidak bersedia' => 'Tidak bersedia',
                                            ])
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('ps_kadm_status') !== 'Santri/Santriwati tidak mampu'
                                            ),

                                        Radio::make('ps_kadm_atur_keuangan')
                                            ->label('3. Keuangan ananda akan dipegang dan diatur oleh Mahad')
                                            ->required()
                                            ->default('Bersedia')
                                            ->options([
                                                'Bersedia' => 'Bersedia',
                                                'Tidak bersedia' => 'Tidak bersedia',
                                            ])
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('ps_kadm_status') !== 'Santri/Santriwati tidak mampu'
                                            ),

                                        Radio::make('ps_kadm_penentuan_subsidi')
                                            ->label('4. Yang menentukan bentuk keringanan yang diberikan adalah Mahad')
                                            ->required()
                                            ->default('Bersedia')
                                            ->options([
                                                'Bersedia' => 'Bersedia',
                                                'Tidak bersedia' => 'Tidak bersedia',
                                            ])
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('ps_kadm_status') !== 'Santri/Santriwati tidak mampu'
                                            ),

                                        Radio::make('ps_kadm_hidup_sederhana')
                                            ->label('5. Ananda harus berpola hidup sederhana agar tidak menimbulkan pertanyaan pihak luar')
                                            ->required()
                                            ->default('Bersedia')
                                            ->options([
                                                'Bersedia' => 'Bersedia',
                                                'Tidak bersedia' => 'Tidak bersedia',
                                            ])
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('ps_kadm_status') !== 'Santri/Santriwati tidak mampu'
                                            ),

                                        Radio::make('ps_kadm_kebijakan_subsidi')
                                            ->label('6. Kebijakan subsidi bisa berubah sewaktu waktu')
                                            ->required()
                                            ->default('Bersedia')
                                            ->options([
                                                'Bersedia' => 'Bersedia',
                                                'Tidak bersedia' => 'Tidak bersedia',
                                            ])
                                            ->hidden(
                                                fn (Get $get) =>
                                                $get('ps_kadm_status') !== 'Santri/Santriwati tidak mampu'
                                            ),
                                    ]),
                            ]),
                        // end of Section 4
                    ])
            ]);
    }
}
