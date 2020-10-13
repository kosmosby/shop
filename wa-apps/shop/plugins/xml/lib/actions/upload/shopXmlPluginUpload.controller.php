<?php
class shopXmlPluginUploadController extends shopUploadController {

    protected $name = 'xml_file';
    protected function save(waRequestFile $file) {
        $profile_id = waRequest::request('profile_id', 0, waRequest::TYPE_INT);

        $path = wa()->getDataPath('plugins/xml/' . $profile_id . '/', true, 'shop', true) . $profile_id . '.local.xml';

        if ( file_exists($path) ){
            waFiles::delete($path);
        }

        $file->moveTo($path);

        $settings = shopXmlHelper::getProfileConfig($profile_id);
        $settings['local.file'] = $file->name;
        $settings['local.file.size'] = waFiles::formatSize($file->size);

        shopXmlHelper::saveProfileConfig($profile_id, $settings);

        return array(
            'name' => $file->name,
            'size' => waFiles::formatSize($file->size),
        );
    }

}