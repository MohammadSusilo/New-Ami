<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisan;
use File;
use Log;
use Session;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    public function index()
    {
        try {

            // $path = public_path('storage/files/Pusat/Backup');
            // $filesInFolder = File::allFiles($path);


            // foreach($filesInFolder as $key => $path){
            //     $files = pathinfo($path);
            //     $filesArr[] = array( 'fileName' => $files['basename'], 'fileUrl' => "/storage/files/Pusat/Backup/".$files['basename'] );
            // }
            // return view('menu/setting/backup/index', compact('filesArr'));

            $disk = Storage::disk(config('laravel-backup.backup.destination.disks'));
            $files = $disk->files('/AMI/');
            $backups = [];
            foreach ($files as $k => $f) {
               if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                   $backups[] = [
                   'file_path' => $f,
                   'file_name' => str_replace(config('laravel-backup.backup.name') . 'AMI/', '', $f),
                   'file_size' => $disk->size($f),
                   'last_modified' => $disk->lastModified($f),
                    ];
               }
            }
            $backups = array_reverse($backups);
            return view("menu/setting/backup/index")->with(compact('backups'));
    
        } catch ( Exception $ex ) {
            Log::error( $ex->getMessage() );
        }
    }

    public static function humanFileSize($size,$unit="") {
            if( (!$unit && $size >= 1<<30) || $unit == "GB")
                return number_format($size/(1<<30),2)."GB";
            if( (!$unit && $size >= 1<<20) || $unit == "MB")
                return number_format($size/(1<<20),2)."MB";
            if( (!$unit && $size >= 1<<10) || $unit == "KB")
                return number_format($size/(1<<10),2)."KB";
            return number_format($size)." bytes";
    }
    
    // public function generate(){
    //     try{
                    
    //         $exitCode = Artisan::call('database:backup');
    //         Artisan::queue('database:backup');
    //         dd(Artisan::output());
    //         return back()->with('success', 'Backup Done !');
    
    //     }catch (Exception $exc) {
    //         abort(404, $exc->getMessage());
    //     }
    // }

    public function download($file_name) 
    {
        $file = config('laravel-backup.backup.name') .'/AMI/'. $file_name;
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks'));

        if ($disk->exists($file)) {
            $fs = Storage::disk(config('laravel-backup.backup.destination.disks'))->getDriver();
            $stream = $fs->readStream($file);

            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type" => $fs->getMimetype($file),
                "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        } else {
            abort(404, "Backup file doesn't exist.");
        }
    }

    public function create()
    {
        try {
                /* only database backup*/
            Artisan::call('backup:run --only-db');
                /* all backup */
                /* Artisan::call('backup:run'); */
                $output = Artisan::output();
                // dd($output);
                Log::info("Backpack\BackupManager -- new backup started \r\n" . $output);
                session()->flash('success', 'Successfully created backup!');
                return redirect()->back();
        } catch (Exception $e) {
                session()->flash('danger', $e->getMessage());
                return redirect()->back();
        }
    }
    
    public function restore($file_name)
    {
        try {
            $file = config('laravel-backup.backup.name') .'/AMI/'. $file_name;
            $disk = Storage::disk(config('laravel-backup.backup.destination.disks'));
            dd($file);
            //     /* only database backup*/
            // Artisan::call('backup:run --only-db');
            //     /* all backup */
            //     /* Artisan::call('backup:run'); */
            //     $output = Artisan::output();
            //     // dd($output);
            //     Log::info("Backpack\BackupManager -- new backup started \r\n" . $output);
            //     session()->flash('success', 'Successfully created backup!');
            //     return redirect()->back();
        } catch (Exception $e) {
                session()->flash('danger', $e->getMessage());
                return redirect()->back();
        }
    }

    public function delete($file_name){
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks'));
        if ($disk->exists(config('laravel-backup.backup.name') . '/AMI/' . $file_name)) {
             $disk->delete(config('laravel-backup.backup.name') . '/AMI/' . $file_name);
            //  session()->flash('success', 'Successfully deleted backup!');
             return redirect()->back()->with('success', 'Successfully deleted backup!');
        } else {
             abort(404, "Backup file doesn't exist.");
        }
   }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
