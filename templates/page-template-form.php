<?php
/*
Template Name: Service Form Template
*/
get_header();
?>

<div class="form-container">
    <form id="service-form">
        <h1><?php echo __("Service Form", "custom-grid"); ?></h1>
        <div class="form-group">
            <label for="name"><?php echo __("Name", "custom-grid"); ?></label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="phone"><?php echo __("Phone", "custom-grid"); ?></label>
            <input type="tel" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="email"><?php echo __("Email", "custom-grid"); ?></label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="service-type"><?php echo __("Service Type", "custom-grid"); ?></label>
            <select id="service-type" name="service-type" required>
                <option value="Repair"><?php echo __("Repair", "custom-grid"); ?></option>
                <option value="Buying"><?php echo __("Buying", "custom-grid"); ?></option>
                <option value="Selling"><?php echo __("Selling", "custom-grid"); ?></option>
            </select>
        </div>
        <button type="submit"><?php echo __("Submit", "custom-grid"); ?></button>
    </form>
</div>
<?php get_footer(); ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('service-form').addEventListener('submit', function (e) {
            e.preventDefault();

            const name = document.getElementById('name').value;
            const phone = document.getElementById('phone').value;
            const email = document.getElementById('email').value;
            const serviceType = document.getElementById('service-type').value;

            const currentUrl = window.location.href;
            const userAgent = navigator.userAgent;

            const formData = {
                user_name: name,
                phone: phone,
                email: email,
                serviceType: serviceType,
                url: currentUrl,
                userAgent: userAgent
            };
            const queryString = new URLSearchParams(formData).toString();
            const thankYouUrl = '<?php echo esc_url(site_url() . "/thank-you"); ?>?' + queryString;

            window.location.href = thankYouUrl;
        });
    });
</script>

<style>
.form-container {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100vh;
    margin: 0 auto;
  }
  
  #service-form {
    width: 100%;
    max-width: 600px;
    background-color: white;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
  }
  form {
    width: 100%;
    max-width: 600px;
    background-color: white;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
  }
  
  .form-group {
    margin-bottom: 15px;
  }
  
  label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
  }
  
  input,
  select {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1); /* Inner shadow for depth */
  }
  
  button {
    width: 100%;
    padding: 10px;
    background-color: #0073aa;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 4px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s;
  }
  
  button:hover {
    background-color: #005f8a; 
  }
</style>