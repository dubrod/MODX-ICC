<?php
class iccResourceCreateManagerController extends ResourceCreateManagerController {
    public function getLanguageTopics() {
        return array('resource','iccresource:default');
    }
}