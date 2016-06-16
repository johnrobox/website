<?php

/*
 * Form Custom Library
 * Helps construct your form field 
 * Author : John Robert Jerodiaz (Roy)
 * Date :  June 10, 2016
 */
class Form {
    
    /*
     * Text - for text type field
     * @param : $name (String)
     * @param : $placeholder (String)
     * @param : $value (String or boolean)
     * @return : $field (array)
     */
    public function text($name, $placeholder, $value) {
        $field = $this->default_attr_value($name, $placeholder, $value);
        $field['type'] = 'text';
        return $field;
    }
    
    /*
     * Text - for email type field
     * @param : $name (String)
     * @param : $placeholder (String)
     * @param : $value (String or boolean)
     * @return : $field (array)
     */
    public function email($name, $placeholder, $value) {
        $field = $this->default_attr_value($name, $placeholder, $value);
        $field['type'] = 'email';
        return $field;
    }
    
    /*
     * Text - for password type field
     * @param : $name (String)
     * @param : $placeholder (String)
     * @param : $value (String or boolean)
     * @return : $field (array)
     */
    public function password($name, $placeholder, $value) {
        $field = $this->default_attr_value($name, $placeholder, $value);
        $field['type'] = 'password';
        return $field;
    }
    
    /*
     * Hidden - for hidden form
     * @param : $name (String)
     * @param : $value (String, int )
     * @return : ($field (array)
     */
    public function hidden($name, $value) {
        $attr = array(
            'type' => 'hidden',
            'name' => $name,
            'value' => $value
        );
        return $attr;
    }
    
    /*
     * default attr field
     * @param : $name (String)
     * @param : $placeholder (String)
     * @param : $value (String or boolean)
     * @return : $attr (array)
     */
    private function default_attr_value($name, $placeholder, $value) {
        $attr = array(
            'name' => $name,
            'id' => $name,
            'class' => 'form-control',
            'value' => ($value == false) ? set_value($name) : $value,
            'placeholder' => $placeholder
        );
        return $attr;
    }
    
    /*
     * submit form button
     * @param : $content (String)
     * @return : $button (array)
     */
    public function submit($content){
        $button = array(
            'type' => 'submit',
            'class' => 'btn btn-primary',
            'content' => $this->get_icon('plus').$content
        );
        return $button;
    }
    
    
    /*
     * reset form button
     * @param : $content (String)
     * @return : $button (array) 
     */
    public function reset($content) {
        $button = array(
            'type' => 'reset',
            'class' => 'btn btn-default',
            'content' => $this->get_icon('refresh').$content
        );
        return $button;
    }
    
    /*
     * button icon 
     * @param : $icon_name (String)
     * @return : $icon (String)
     */
    private function get_icon($icon_name) {
        $icon = '<span class="fa fa-'.$icon_name.'"></span> ';
        return $icon;
    }
    
    
}