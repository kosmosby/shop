<?php

/**
 * @author MorbiPlay.com <support@morbiplay.com>
 * @link http://morbiplay.com/
 */
class shopRevolutionsliderPluginBackendPhotouploadController extends waJsonController {

    public function execute() {
        try {
            $img_dirname = 'img';

            $file = waRequest::file('files');
            $file_name = $file->name;

            if (!$file->uploaded()) {
                $this->setError('No file uploaded.');
                return;
            }

            try {
                $img = $file->waImage();
            } catch(Exception $e) {
                $this->setError('File is not an image ('.$e->getMessage().').');
                return;
            }

            $dir = wa()->getDataPath($img_dirname, true);

            $i = strrpos($file_name, '.');
            $name = substr($file_name, 0, $i);
            $ext = substr($file_name, $i + 1);

            $name_wo_ext = $name;

            if (file_exists($dir . DIRECTORY_SEPARATOR . $file_name)) {
                $i = 1;
                while (file_exists($dir . DIRECTORY_SEPARATOR . $name . '-' . $i . '.' . $ext)) {
                    $i++;
                }
                $name_wo_ext = $name . '-' . $i;
            }

            $fname = $name_wo_ext . '.' . $ext;
            $img->save($dir . DIRECTORY_SEPARATOR . $fname);

            $path = wa()->getDataUrl($img_dirname, true);
            $full_img_url = $path . '/' . $fname;


            $thumb_dir = wa()->getDataPath($img_dirname . '/thumb', true);
            $img->resize(200, 200);
            $thumb_img_path = $thumb_dir . DIRECTORY_SEPARATOR . $fname;
            $img->save($thumb_img_path);

            $path = wa()->getDataUrl($img_dirname . '/thumb', true);
            $thumb_img_url = $path . '/' . $fname;


            $this->response['file'] = array('url' => $full_img_url, 'thumbnailUrl' => $thumb_img_url);
        } catch (Exception $e) {
            $this->setError($e->getMessage());
        }
    }
}
