<?php
class iccResourceUpdateManagerController extends ResourceUpdateManagerController {
    public function getLanguageTopics() {
        return array('resource','iccresource:default');
    }
}