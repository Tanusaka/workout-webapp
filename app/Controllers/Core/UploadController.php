<?php 
<?php
/**
 *
 * @author Samu
 */
namespace App\Controllers\Core;

use App\Controllers\Core\BaseController;

class UploadController extends BaseController
{

    public function upload(Type $var = null)
    {
        $input = $this->validate([
            'file' => [
                'uploaded[file]',
                'mime_in[file,image/jpg,image/jpeg,image/png]',
                'max_size[file,1024]',
            ]
        ]);

        if (!$input) {
            print_r('Choose a valid file');
        } else {
            $img = $this->request->getFile('file');
            $img->move(WRITEPATH . 'uploads');
    
            $data = [
               'name' =>  $img->getName(),
               'type'  => $img->getClientMimeType()
            ];
    
            // $save = $db->insert($data);
            // print_r('File has successfully uploaded');        
        }
    }

}