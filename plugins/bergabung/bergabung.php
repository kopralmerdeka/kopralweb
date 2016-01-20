<?php

/*
  Plugin Name: Bergabung!
  Plugin URI: http://kopralmerdeka.id
  Description: Customized registration plugin for kopralmerdeka
  Version: 0.1
  Author: Herpiko Dwi Aguno <herpiko@gmail.com>
 */


class bergabung {
  private $username;
  private $email;
  private $password;
  private $website;
  private $nickname;
  private $bio;

  function __construct() {
      add_shortcode('bergabung', array($this, 'shortcode'));
      add_action('wp_enqueue_scripts', array($this, 'flat_ui_kit'));
  }
  public function registration_form() {
?>
      <form id="bergabung" method="post" class="bergabung" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>">
          <div class="login-form">
              <div class="bergabung-form-group form-group">
                  <input name="reg_nickname" type="text" class="form-control login-field"
                         value="<?php echo(isset($_POST['reg_nickname']) ? $_POST['reg_nickname'] : null); ?>"
                         placeholder="Nama komunitas" id="reg-nickname" required />
                  <label class="login-field-icon fui-user" for="reg-nickname"></label>
              </div>
              <div class="bergabung-form-group form-group">
                  <textarea name="reg_bio" rows="5" type="text" class="form-control login-field"
                         value="<?php echo(isset($_POST['reg_bio']) ? $_POST['reg_bio'] : null); ?>"
                         placeholder="Deskripsi komunitas" id="reg-bio" required/></textarea>
                  <label class="login-field-icon fui-new" for="reg-bio"></label>
              </div>
              <div class="bergabung-form-group form-group">
                  <input name="reg_name" type="text" class="form-control login-field"
                         value="<?php echo(isset($_POST['reg_name']) ? $_POST['reg_name'] : null); ?>"
                         placeholder="Nama pengguna" id="reg-name" required/>
                  <label class="login-field-icon fui-user" for="reg-name"></label>
              </div>
              <div class="bergabung-form-group form-group">
                  <input name="reg_email" type="email" class="form-control login-field"
                         value="<?php echo(isset($_POST['reg_email']) ? $_POST['reg_email'] : null); ?>"
                         placeholder="Surat elektronik" id="reg-email" required/>
                  <label class="login-field-icon fui-mail" for="reg-email"></label>
              </div>
              <div class="bergabung-form-group form-group">
                  <input name="reg_password" type="password" class="form-control login-field"
                         value="<?php echo(isset($_POST['reg_password']) ? $_POST['reg_password'] : null); ?>"
                         placeholder="Kata sandi" id="reg-pass" required/>
                  <label class="login-field-icon fui-lock" for="reg-pass"></label>
              </div>
              <div class="bergabung-form-group form-group">
                  <input name="reg_website" type="text" class="form-control login-field"
                         value="<?php echo(isset($_POST['reg_website']) ? $_POST['reg_website'] : null); ?>"
                         placeholder="Website atau tautan lainnya" id="reg-website"/>
                  <label class="login-field-icon fui-chat" for="reg-website"></label>
              </div>
              <input class="bergabung-button btn btn-primary btn-lg btn-block" type="submit" name="reg_submit" value="Bergabung!"/>
      </form>
      </div>
<?php
  }
  function validation() {
    if (empty($this->username) || empty($this->password) || empty($this->email)) {
      return new WP_Error('field', 'Ada beberapa isian yang masih kosong');
    }
    if (strlen($this->username) < 4) {
      return new WP_Error('username_length', 'Nama pengguna terlalu pendek. Minimal 4 karakter');
    }
    if (strlen($this->password) < 5) {
      return new WP_Error('password', 'Kata sandi harus lebih dari 5 karakter');
    }
    if (!is_email($this->email)) {
      return new WP_Error('email_invalid', 'Surat elektronik tidak valid');
    }
    if (email_exists($this->email)) {
      return new WP_Error('email', 'Surat elektronik sudah digunakan');
    }
    if (!empty($website)) {
      if (!filter_var($this->website, FILTER_VALIDATE_URL)) {
        return new WP_Error('website', 'Bukan URL website yang valid.');
      }
    }
    $details = array('Username' => $this->username,
      'Nickname' => $this->nickname,
      'bio' => $this->bio
    );
    foreach ($details as $field => $detail) {
      if (!validate_username($detail)) {
        return new WP_Error('name_invalid', 'Maaf, "' . $field . '" yang Anda masukkan tidak valid.');
      }
    }
  }
  function registration(){
    $userdata = array(
      'user_login' => esc_attr($this->username),
      'user_email' => esc_attr($this->email),
      'user_pass' => esc_attr($this->password),
      'user_url' => esc_attr($this->website),
      'nickname' => esc_attr($this->nickname),
      'description' => esc_attr($this->bio),
    );

    echo '<script>document.getElementById("join").scrollIntoView();</script>';
    if (is_wp_error($this->validation())) {
      echo '<div style="margin-bottom: 6px;text-align:center;font-family:\'Arial\';" class="btn btn-block btn-lg btn-danger">';
      echo '<strong>' . $this->validation()->get_error_message() . '</strong>';
      echo '</div>';
    } else {
      $register_user = wp_insert_user($userdata);
      if (!is_wp_error($register_user)) {
        echo '<div style="margin-bottom: 6px" class="btn btn-block btn-lg btn-danger">';
        echo '<strong>Terima kasih sudah bergabung. Kami akan mengontak Anda lebih lanjut melalui surat elektronik mengenai aktivasi akun.</strong>';
        echo '</div>';
      } else {
        echo '<div style="margin-bottom: 6px" class="btn btn-block btn-lg btn-danger">';
        echo '<strong>' . $register_user->get_error_message() . '</strong>';
        echo '</div>';
      }
    }
  }
  function flat_ui_kit(){
    wp_enqueue_style('bergabung', plugins_url('css/bergabung.css', __FILE__));
  }
  function shortcode() {
    ob_start();
    if ($_POST['reg_submit']) {
        $this->username = $_POST['reg_name'];
        $this->email = $_POST['reg_email'];
        $this->password = $_POST['reg_password'];
        $this->website = $_POST['reg_website'];
        $this->nickname = $_POST['reg_nickname'];
        $this->bio = $_POST['reg_bio'];
        $this->validation();
        $this->registration();
    }
    $this->registration_form();
    return ob_get_clean();
  }
}

new bergabung;
