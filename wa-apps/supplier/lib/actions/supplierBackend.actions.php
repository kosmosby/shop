<?php


class supplierBackendActions extends waViewActions
{
    public function defaultAction()
    {
        // создаем экземпляр модели для получения данных из БД
        $model = new supplierModel();
        // получаем записи гостевой книги из БД
        $records = $model->order('datetime DESC')->fetchAll();
        // передаем записи в шаблон
        $this->view->assign('records', $records);
        // передаём URL фронтенда в шаблон
        $this->view->assign('url', wa()->getRouting()->getUrl('guestbook'));
        /*
        * передаём в шаблон права пользователя на удаление записей из гостевой книги
        * права описаны в файле lib/config/guestbookRightConfig.class.php
        */
        $this->view->assign('rights_delete', $this->getRights('delete'));
    }
    public function deleteAction()
    {
        //реализация экшена удаления записи
    }
}