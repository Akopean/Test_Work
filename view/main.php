<!-- BEGIN Main -->
<main role="main">
  <div class="row">
    <div class="medium-6 small-12 small-centered columns">
      <div class="row">
        <div class="switch switch-align round">
          <input id="on-off" type="checkbox" <?php if($_SESSION['lang'] === "Ru")
          echo "checked"; ?>>
            <label for="on-off">
              <span class="switch-on">Ru</span>
              <span class="switch-off">En</span>
          </label>
        </div>
      </div>
    </div>
    <div class="medium-6 small-12 small-centered columns">
          <ul class="tabs tabs-pad" data-tab role="tablist">
            <li class="tab-title active" role="presentation"><a href="#panel2-1" role="tab" tabindex="0" aria-selected="true" aria-controls="panel2-1"><img class="tabs-icon" src="icon/user.svg"><?= $render[$_SESSION['lang']]['_login_'];?></a></li>
            <li class="tab-title" role="presentation"><a id="aria-active" href="#panel2-2" role="tab" tabindex="0" aria-selected="false" aria-controls="panel2-2"><img class="tabs-icon" src="icon/unlocked.svg"><?= $render[$_SESSION['lang']]['_registration_'];?></a></li>
          </ul>
    <div class="tabs-content">
      <section role="tabpanel" aria-hidden="false" class="content active" id="panel2-1">
       <form name="login" method="post" accept-charset="UTF-8">
        <fieldset>
          <legend><?= $render[$_SESSION['lang']]['_login_'];?></legend>
            <div class="row">
              <div class="large-12 columns">
                <label><?= $render[$_SESSION['lang']]['_login_'];?> <small><?= $render[$_SESSION['lang']]['_required_'];?></small>
                  <input name="l_login" type="text" required placeholder="<?= $render[$_SESSION['lang']]['_login_'];?>" />
                </label>
              </div>
            </div>
            <div class="row">
              <div class="large-12 columns">
                <label><?= $render[$_SESSION['lang']]['_password_'];?> <small><?= $render[$_SESSION['lang']]['_required_'];?></small>
                  <input name="l_password" type="password" id="password" placeholder="<?= $render[$_SESSION['lang']]['_password_'];?>" name="password" required>
                </label>
              </div>
            </div>
             <small id="l_err" hidden></small>
            <button id="send_login" type="submit" class="button expand"><?= $render[$_SESSION['lang']]['_login_'];?></button>
          </fieldset>
        </form>
  </section>
  <section role="tabpanel" aria-hidden="true" class="content" id="panel2-2">
     <form novalidate="" name="register" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
        <fieldset>
          <legend><?= $render[$_SESSION['lang']]['_registration_'];?></legend>
            <div class="row">
              <div class="large-12 columns">
                <label><?= $render[$_SESSION['lang']]['_name_'];?> <small><?= $render[$_SESSION['lang']]['_required_'];?></small>
                  <input name="r_name" type="text" required autofocus placeholder="<?= $render[$_SESSION['lang']]['_name_'];?>" />
                </label>
              </div>
            </div>
            <div class="row">
              <div class="large-12 columns">
                <label><?= $render[$_SESSION['lang']]['_login_'];?> <small><?= $render[$_SESSION['lang']]['_required_'];?></small>
                  <input name="r_login" type="text" required placeholder="<?= $render[$_SESSION['lang']]['_login_'];?>" />
                </label>
              </div>
            </div>
            <div class="row">
              <div class="large-12 columns">
                <label><?= $render[$_SESSION['lang']]['_password_'];?> <small><?= $render[$_SESSION['lang']]['_required_'];?></small>
                  <input name="r_password" type="password" placeholder="<?= $render[$_SESSION['lang']]['_password_'];?>" name="password" required>
                </label>
              </div>
            </div>
            <div class="row">
              <div class="large-12 columns">
                <label><?= $render[$_SESSION['lang']]['_confirmpassword_'];?> <small><?= $render[$_SESSION['lang']]['_required_'];?></small>
                  <input name="re_password" type="password" placeholder="<?= $render[$_SESSION['lang']]['_confirmpassword_'];?>" name="confirmPassword" required>
                </label>
              </div>
            </div>
            <div class="row">
              <div class="large-12 columns">
                <label><?= $render[$_SESSION['lang']]['_email_'];?> <small><?= $render[$_SESSION['lang']]['_required_'];?></small>
                  <input name="r_email" type="email" id="email" required placeholder=" example@email.com">
                </label>
              </div>
            </div>
            <div class="row">
              <div class="large-12 columns">
                <label><?= $render[$_SESSION['lang']]['_avatar_'];?>
                  <input id="uploadInput" name="r_file" type="file" accept="image/jpeg,image/png,image/gif" class="file-input">
                </label>
              </div>
            </div>
            <div class="row">
              <div class="large-6 columns">
                <label><?= $render[$_SESSION['lang']]['_gender_'];?></label>
                <input type="radio" name="r_gender" id="men" checked value="M"><label for="men"><img class="tabs-icon" src="icon/man.svg" title="<?= $render[$_SESSION['lang']]['_male_'];?>"></label>
                <input type="radio" name="r_gender" id="women" value="W"><label for="women"><img class="tabs-icon" src="icon/woman.svg" title="<?= $render[$_SESSION['lang']]['_female_'];?>"></label>
              </div>
            </div>
             <small id="r_err" hidden></small>
            <button  id="reg_user" type="submit" class="button expand"><?= $render[$_SESSION['lang']]['_signup_'];?></button>
            </fieldset>
          </form>
        </section>
      </div>
    </div>
  </div>
</main>
