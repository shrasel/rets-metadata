<style type="text/css">

    .form-signin {
        max-width: 600px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
        -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
        box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
    }

    .form-signin .form-signin-heading{
        margin: 0 0 20px 0;
        text-align: center;
    }



</style>
    <h1 class="text-center">RETS SERVER TESTING</h1>
<form class="form-signin form-horizontal" name="login" action="" method="post">
    <h2 class="form-signin-heading">Log In</h2>
    <?php if($this->session->flashdata('msg')):?>
    <div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button><?=$this->session->flashdata('msg')?></div>
    <?php endif; ?>


    <div class="control-group">
        <label class="control-label" for="rets_url">LOGIN URL: </label>
        <div class="controls">
            <input id="rets_url" type="text" name="url" value="<?=set_value('url')?>" class="input-block-level" placeholder="RETS URL">
            </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="rets_username">USERNAME: </label>
        <div class="controls">
            <input id="rets_username" type="text" value="<?=set_value('username')?>" name="username" class="input-block-level" placeholder="RETS USERNAME">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="rets_password">PASSWORD: </label>
        <div class="controls">
            <input id="rets_password" type="password" value="<?=set_value('password')?>" name="password" class="input-block-level" placeholder="RETS PASSWORD">
            </div>
        </div>
    <!--<label class="checkbox">
        <input type="checkbox" value="remember-me"> Remember me
    </label>-->
    <div class="control-group">
        <label class="control-label" for="rets_password"></label>
        <div class="controls">
            <button class="btn btn-large btn-primary text-center" type="submit">Log in</button>
        </div>
    </div>

</form>