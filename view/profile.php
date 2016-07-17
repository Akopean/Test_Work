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
  <div class="tabs-content ">
    <h1 class="text-center"><?= $render[$_SESSION['lang']]['_welcome_'].': '.ucfirst($_SESSION['user']['name']); ?></h1>
    <p class="text-center"><img class="avatar" src="image/<?= $_SESSION['user']['avatar']?>" alt='<?= $render[$_SESSION['lang']]['_avatar_'];?>'></p>
    <section>
     <form novalidate="" name="register" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
        <fieldset>
          <legend><?= $render[$_SESSION['lang']]['_profile_'];?></legend>
            <div class="row">
              <div class="large-12 columns">
                <label><?= $render[$_SESSION['lang']]['_name_'];?>
                  <input name="u_name" type="text" required autofocus placeholder="<?= $render[$_SESSION['lang']]['_name_'];?>"  <? if(!empty($_SESSION['user']['name'])) echo 'value="'.$_SESSION['user']['name'].'"'; ?>" />
                </label>
              </div>
            </div>
            <div class="row">
              <div class="large-12 columns">
                <label><?= $render[$_SESSION['lang']]['_email_'];?>
                  <input name="u_email" type="email" id="email" required placeholder="example@email.com" <? if(!empty($_SESSION['user']['email'])) echo 'value="'.$_SESSION['user']['email'];?>">
                </label>
              </div>
            </div>
            <div class="row">
              <div class="large-12 columns">
                <label><?= $render[$_SESSION['lang']]['_avatar_'];?>
                  <input id="uploadInput" name="u_file" type="file" accept="image/jpeg,image/png,image/gif" class="file-input">
                </label>
              </div>
            </div>
            <div class="row">
              <div class="large-6 columns">
                <label><?= $render[$_SESSION['lang']]['_gender_'];?></label>
                <input type="radio" name="u_gender" id="men" <? if($_SESSION['user']['gender'] === 'M') echo "checked"; ?> value="M"><label for="men"><img class="tabs-icon" src="icon/man.svg" alt="<?= $render[$_SESSION['lang']]['_male_'];?>"></label>
                <input type="radio" name="u_gender" <? if($_SESSION['user']['gender'] === 'W')  echo "checked"; ?> id="women" value="W"><label for="women"><img class="tabs-icon" src="icon/woman.svg" alt="<?= $render[$_SESSION['lang']]['_female_'];?>"></label>
              </div>
            </div>
             <small id="r_err" hidden></small>
            <button  id="upd_user" type="submit" class="button expand"><?= $render[$_SESSION['lang']]['_update_'];?></button><hr />
            <button  id="exit_user" type="submit" class="button expand"><?= $render[$_SESSION['lang']]['_exit_'];?></button>
            </fieldset>
          </form>
        </section>
      </div>
    </div>
  </div>
</main>
