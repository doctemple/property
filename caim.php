<?php 
session_start();
include('components/head.php');
include('components/top.php');
?>
<style>
/* CSS */
@supports (-webkit-appearance: -apple-pay-button) {
    .apple-pay-button-with-text {
        display: inline-block;
        -webkit-appearance: -apple-pay-button;
        -apple-pay-button-type: buy;
    }
    .apple-pay-button-with-text > * {
        display: none;
    }
    .apple-pay-button-black-with-text {
        -apple-pay-button-style: black;
    }
    .apple-pay-button-white-with-text {
        -apple-pay-button-style: white;
    }
    .apple-pay-button-white-with-line-with-text {
        -apple-pay-button-style: white-outline;
    }
}


@supports not (-webkit-appearance: -apple-pay-button) {
    .apple-pay-button-with-text {
        --apple-pay-scale: 1; /* (height / 32) */
        display: inline-flex;
        justify-content: center;
        font-size: 12px;
        border-radius: 5px;
        padding: 0px;
        box-sizing: border-box;
        min-width: 200px;
        min-height: 32px;
        max-height: 64px;
    }
    .apple-pay-button-black-with-text {
        background-color: black;
        color: white;
    }
    .apple-pay-button-white-with-text {
        background-color: white;
        color: black;
    }
    .apple-pay-button-white-with-line-with-text {
        background-color: white;
        color: black;
        border: .5px solid black;
    }
    .apple-pay-button-with-text.apple-pay-button-black-with-text > .logo {
        background-image: -webkit-named-image(apple-pay-logo-white);
        background-color: black;
    }
    .apple-pay-button-with-text.apple-pay-button-white-with-text > .logo {
        background-image: -webkit-named-image(apple-pay-logo-black);
        background-color: white;
    }
    .apple-pay-button-with-text.apple-pay-button-white-with-line-with-text > .logo {
        background-image: -webkit-named-image(apple-pay-logo-black);
        background-color: white;
    }
    .apple-pay-button-with-text > .text {
        font-family: -apple-system;
        font-size: calc(1em * var(--apple-pay-scale));
        font-weight: 300;
        align-self: center;
        margin-right: calc(2px * var(--apple-pay-scale));
    }
    .apple-pay-button-with-text > .logo {
        width: calc(35px * var(--scale));
        height: 100%;
        background-size: 100% 60%;
        background-repeat: no-repeat;
        background-position: 0 50%;
        margin-left: calc(2px * var(--apple-pay-scale));
        border: none;
    }
}
   
</style>

<!-- Content Middle //-->
<div class="page animated bounceInDown">
    <div class="container-fluid">

    
<div class="apple-pay-button-with-text apple-pay-button-white-with-text">
  <span class="text">Buy with</span>
  <span class="logo"></span>
</div>



    </div>
</div>

<!-- Content Bottom //-->
<div class="animated bounceInLeft" style="text-align:center;  align-items: center;  justify-content: center; ">
    <?php //echo nl2br(print_r($_SESSION,'r')); ?>
</div>

<!-- Footer //-->
<?php include('components/foot.php'); ?>