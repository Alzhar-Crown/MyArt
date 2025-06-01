<?php

namespace App\Http\Controllers;

// use Intervention\Image\Facades\Image;
use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class ControllerCatalog extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $porto = Catalog::where('status', '<>', 'sold')->get();

        $categorized = [
            'uiux' => [],
            'realpic' => [],
            '2d' => [],
            '3d' => [],
        ];

        foreach ($porto as $item) {
            switch ($item->kategori_desain) {
                case 'ui/ux':
                    $categorized['uiux'][] = $item;
                    break;
                case 'realpic':
                    $categorized['realpic'][] = $item;
                    break;
                case '2d illustration':
                    $categorized['2d'][] = $item;
                    break;
                case '3d illustration':
                    $categorized['3d'][] = $item;
                    break;
            }
        }
        return view('catalog', compact('categorized'));
    }

    public function scatal($kategori)
    {
        $catal = Catalog::where('status', '<>', 'sold')->where('kategori_desain', $kategori)->get();

        $total = $catal->sum('harga');



        return view('scatalog', compact('catal', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('form+cat');
        //
    }

    private function createPhashFromJpeg(string $path): string
    {
        // 1) Load source
        $src = @imagecreatefromjpeg($path);
        if (! $src) {
            throw new \RuntimeException("Gagal load JPEG: {$path}");
        }

        // 2) Buat canvas 8×8
        $thumb = imagecreatetruecolor(8, 8);

        // 3) Resize down
        imagecopyresampled(
            $thumb,
            $src,
            0,
            0,
            0,
            0,
            8,
            8,
            imagesx($src),
            imagesy($src)
        );

        // 4) Bangun hash
        $hash = '';
        for ($y = 0; $y < 8; $y++) {
            for ($x = 0; $x < 8; $x++) {
                $rgb = imagecolorat($thumb, $x, $y);
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;
                $gray = ($r + $g + $b) / 3;
                // karena grayscale: cuma pakai R
                $hash .= ($gray > 127) ? '1' : '0';
            }
        }

        imagedestroy($src);
        imagedestroy($thumb);
        return $hash;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $imageManager = new ImageManager(new GdDriver());
        // $imageManager = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
        // dd(get_class($imageManager), get_class_methods($imageManager));


        $request->validate([
            'preview' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2000',
            'file_desain' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:50000',
            'deskripsi' => 'max:200'
        ]);

        $fileDesain = $request->file('file_desain');
        $kategori_desain = $request['kategori_desain'];

        // Cek kemiripan
        if ($this->isImageTooSimilar($fileDesain, $kategori_desain)) {
            return back()->withErrors(['catalog_image' => 'Image has been published']);
        }

        // Hitung hash dengan GD
        $hash = $this->createPhashFromAnyImage($fileDesain->getRealPath());




        $catalog = new Catalog();
        $uppr = $request->file('preview');
        $preview = $imageManager->read($uppr->getContent());

        $originalName = $uppr->getClientOriginalName();
        $namaPreview = time() . '_' . $originalName;

        $watermark = $imageManager->read(public_path('images/logo.png'));
        $preview->place($watermark, 'bottom-right', 10, 10);
        $preview->place($watermark, 'bottom-left', 10, 10);
        $preview->place($watermark, 'top-right', 30, 20);
        $preview->place($watermark, 'top-right', 50, 100);


        $file = $request->file('file_desain');
        $namaFile = time() . '_' . $file->getClientOriginalName(); // Nama unik

        if ($catalog['preview'] != $file) {
            $file->move(public_path('catalog'), $namaFile);
            $preview->save(public_path('catalog/preview/' . $namaPreview));
        }
        $catalog->perceptual_hash = $hash;
        $catalog->user_id = session('dataProfil')['user_id'];
        $catalog->nama_depan = session('dataProfil')['nama_depan'];
        $catalog->deskripsi = $request['deskripsi'];
        $catalog->headline = $request['headline'];
        $catalog->harga = $request['harga'];
        $catalog->kategori_desain = $request['kategori_desain'];
        $catalog->preview = $namaPreview;
        $catalog->file_desain = $namaFile;
        $catalog->save();
        return redirect()->route('clearCatalog');
        //
    }

    public function selling()
    {
        $data = Catalog::where('user_id', Auth::id())->where('status', 'sold')->get();
        $all = Catalog::where('user_id', Auth::id())->get()->count();
        $total = $data->count();
        $omset = $data->sum('harga');
        $grouped = $data->groupBy(function ($item) {
            return Carbon::parse($item->created_at)->format('M');
        });

        $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $aem = array_fill(0, 12, 0);
        $omsetPerMonth = array_fill(0, 12, 0);

        foreach ($data as $item) {
            $bulanStr = Carbon::parse($item->created_at)->format('M');
            $index = array_search($bulanStr, $bulan);
            if ($index !== false) {
                $omsetPerMonth[$index] += $item->harga;
            }
        }

        foreach ($data as $item) {
            $bulanStr = Carbon::parse($item->created_at)->format('M');

            // Cari index bulan di array $bulan
            $index = array_search($bulanStr, $bulan);
            if ($index !== false) {
                $aem[$index] += 1;
            }
        }
        // Buat chart
        $penjualan = new Chart;
        $penjualan->labels($bulan);
        $penjualan->dataset('Selling Product', 'bar', $aem ?? 0)
            ->backgroundColor('yellow')
            ->color('yellow');

        $omsetBulan = new Chart;
        $omsetBulan->labels($bulan);
        $omsetBulan->dataset('income every month', 'bar', $omsetPerMonth ?? 0)
            ->backgroundColor('green')
            ->color('green');


        return view('selling', compact('data', 'total', 'omset', 'omsetBulan', 'penjualan', 'all'));
    }


    private function isImageTooSimilar(UploadedFile $file, $kategori_desain, $threshold = 8): bool
    {
        $path = $file->getRealPath();
        $hash = $this->createPhashFromAnyImage($path);
        $fileSize = filesize($path);

        $catalogs = Catalog::where('kategori_desain', $kategori_desain)->whereNotNull('perceptual_hash')->get(['perceptual_hash', 'file_desain']);

        foreach ($catalogs as $catalog) {
            $existingPath = public_path('catalog/' . $catalog->file_desain);
            if (!file_exists($existingPath)) {
                continue;
            }

            $existingFileSize = filesize($existingPath);

            // Pra-filter ukuran file, misal beda lebih dari 10KB skip
            if (abs($fileSize - $existingFileSize) > 10240) {
                continue;
            }

            $distance = $this->hammingDistance($hash, $catalog->perceptual_hash);
            logger("Hamming distance: $distance between $hash and {$catalog->perceptual_hash}");

            if ($distance <= $threshold) {
                logger("Found similar image with distance $distance, threshold $threshold");
                return true;
            }
        }
        return false;
    }

    private function createPhashFromAnyImage(string $path): string
    {
        $jpegPath = $this->convertToJpegTempFile($path);
        $hash = $this->createPhashFromJpeg($jpegPath);
        if ($jpegPath !== $path) {
            unlink($jpegPath);
        }
        return $hash;
    }


    private function convertToJpegTempFile(string $path): string
    {
        $mime = mime_content_type($path);

        switch ($mime) {
            case 'image/jpeg':
                return $path;
            case 'image/png':
                $img = imagecreatefrompng($path);
                break;
            case 'image/gif':
                $img = imagecreatefromgif($path);
                break;
            case 'image/webp':
                $img = imagecreatefromwebp($path);
                break;
            default:
                throw new \Exception("Unsupported image MIME type: {$mime}");
        }

        $tmpPath = tempnam(sys_get_temp_dir(), 'conv') . '.jpg';
        imagejpeg($img, $tmpPath, 90);
        imagedestroy($img);
        return $tmpPath;
    }



    private function hammingDistance($hash1, $hash2)
    {
        $distance = 0;
        for ($i = 0; $i < strlen($hash1); $i++) {
            if ($hash1[$i] !== $hash2[$i]) {
                $distance++;
            }
        }
        logger("Hamming distance: {$distance} between {$hash1} and {$hash2}");

        return $distance;
    }




    public function ClearCatalog()
    {
        session()->forget('dataPortofolio');
        $catalog = Catalog::where('user_id', Auth::id())->get();
        session()->put('dataCatalog', [
            'user_id' => Auth::id(),
        ]);

        return view('profil', compact('catalog'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $catal = Catalog::where('id', $id)->first();
        if ($catal->status == 'sold') {
            return view('showSold', compact('catal'));
        }
        session(['previous_url' => url()->previous()]);
        return view('showCatal', compact('catal'));
        //
    }   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
