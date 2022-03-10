<?php

class Component
{
    //Input Component Stuff
    public $icon;
    public $placeholder;
    public $name;
    public $value;
    public $aria_lable;
    //Button Component Stuff
    public $btnid;
    public $styleclass;
    public $text;
    public $btn_name;
    public $btn_icon;
    public $attr;
    //Create an input field
    public function createInputComponent($icon,$placeholder,$name,$value,$aria_label): string
    {
        //Assign the values
        $this->icon = $icon;
        $this->placeholder = $placeholder;
        $this->name = $name;
        $this->value = $value;
        $this->aria_lable = $aria_label;

        return "
          <div class=\"input-group flex-nowrap\">
                      <span class=\"input-group-text bg-warning\" id=\"addon-wrapping\"><i class='$this->icon'></i></span>
                      <input type=\"text\" name='$this->name' value='$this->value' class=\"form-control\" placeholder='$this->placeholder'
                       aria-label='$this->aria_lable' aria-describedby=\"addon-wrapping\">
                  </div>
        ";
    }
    //Create a button
    public function createButton($btnid,$styleclass,$text,$name,$attr,$icon): string
    {
        //Assign values
        $this->btnid = $btnid;
        $this->styleclass = $styleclass;
        $this->text = $text;
        $this->btn_name = $name;
        $this->attr = $attr;
        $this->btn_icon = $icon;

        return "
            <button type='submit' name='$this->btn_name' '$this->attr' class='$this->styleclass' id='$this->btnid'>$this->btn_icon</button>
        ";
    }
}