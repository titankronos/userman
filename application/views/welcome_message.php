<div class="span9">
  <div class="hero-unit">
    <h1>Update your info</h1>
    <p>Have you moved? Did you get a new phone number? Update your contact information
    by logging into your account using your <acronym title="same password used for your email and logging into campus computers">BearPass</acronym> and letting us know.</p>
    <p>
      <?php if($this->session->flashdata('message')) : ?>
      <div class="alert">
        <a class="close" data-dismiss="alert">×</a>
        <?=$this->session->flashdata('message')?>
      </div>
      <?php endif; ?>
      <form class="well form-inline" method="post" action="<?=site_url('welcome/auth')?>">
        <input type="text" class="input-medium"
          placeholder="firstname.lastname" name="username"
            />
        <input type="password" class="input-medium"
          placeholder="BearPass Password" name="password" />
        <button type="submit" name="login" class="btn btn-primary">Login &raquo;</button>
      </form>
    </p>
  </div>
</div><!--/span-->
</div><!--/row-->
