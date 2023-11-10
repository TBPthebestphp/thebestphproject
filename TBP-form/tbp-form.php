<?php

function tbpform ($action='http://thebestphproject.local',$method="post",
    $placeholder1='idea perse',
    $buttonValue='guardar',$morehtml=''
        ) {

    $form = "
    
        <div class='contenedor'>

            <form method='post' action='$action'>
            
                <label>

                    <input type='text' 
                    placeholder='$placeholder1'
                    name='text1' 
                    id='text1'
                    required >
                
                </label>

                $morehtml

                <input type='submit' 
                value='$buttonValue' 
                class='button'>
            
            </form>
        
        </div>

    ";

    return $form;

}