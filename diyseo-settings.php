<?php
// Check if this file is called directly
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function diyseo_settings_page() {
    // Add this at the beginning of the function
 $existing_license_key = get_option('diyseo_license_key');
    
    // Enqueue jQuery first
    wp_enqueue_script('jquery');
    
   wp_enqueue_script('diyseo-settings', plugin_dir_url(__FILE__) . 'js/diyseo-settings.js', array('jquery'), '1.0.0', true);
wp_localize_script('diyseo-settings', 'diyseoAjax', array(
    'ajaxurl' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('diyseo_nonce'),
    'licenseKey' => get_option('diyseo_license_key')
));
    ?>
    <html>
    <head>
    <style>
        /* Card styles */
        .feature-card {
            background-color: #12163A;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(234, 24, 138, 0.7);
            color: #E0E0E0;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin: 20px;
            width: 300px;
        }
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 0 30px rgba(234, 24, 138, 1);
        }
        .feature-icon {
            font-size: 50px;
            margin-bottom: 20px;
            color: #ea188a;
        }
        .feature-title {
            font-size: 24px;
            color: #FFFFFF;
            margin-bottom: 15px;
        }
        .feature-description {
            font-size: 16px;
            color: #E0E0E0;
        }

        /* General layout */
        .card-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 40px;
        }

        /* Large image section */
        .image-section {
            margin-top: 50px;
            text-align: center;
        }
        .image-section img {
            max-width: 80%;
            height: auto;
            border-radius: 15px;
            box-shadow: 0px 0px 20px rgba(234, 24, 138, 0.7);
        }
        .image-section-title {
            color: #FFFFFF;
            font-size: 28px;
            margin-bottom: 20px;
        }
    </style>
    </head>
    <body style="background-color: #080B53;">

    <div class="wrap" style="display: flex; flex-direction: column; align-items: center; min-height: 80vh;">
        <div style="text-align: left; margin-bottom: 20px;">
            <img src="<?php echo esc_url(plugins_url('logo.png', __FILE__)); ?>" alt="DIY SEO Logo" style="max-width: 150px;"/>
        </div>

        <div style="background-color: #FFFFFF; padding: 10px; border-radius: 5px; width: 100%; max-width: 600px; margin-bottom: 20px;box-shadow: 0 8px 16px rgba(0, 0, 0, 0.9);">
            <ul style="list-style: none; padding: 0; margin: 0; display: flex; justify-content: space-around;">
                <li id="show_form1" style="display: inline;"><a href="<?php echo esc_url(admin_url('admin.php?page=diyseo-settings')); ?>" style="color: #080B53; text-decoration: none; padding: 10px; border-radius: 5px; font-weight: bold;">Settings</a></li>
            </ul>
        </div>
<div style="background: #1e1e2f; border-left: 4px solid #9147ff; padding: 20px; margin-bottom: 30px; border-radius: 8px;">
  <h2 style="color: #fff; margin-top: 0;">🔑 Where to Find Your License Key</h2>
  <p style="color: #ccc; font-size: 15px; line-height: 1.6;">
    To unlock full access to the DIYSEO WordPress plugin, you’ll need to enter your license key.
    <br><br>
    👉 Log into <a href="https://diyseo.ai/dashboard" target="_blank" style="color: #66d9ef;">diyseo.ai</a> and you’ll see your license key at the <strong>top-left corner</strong> of the dashboard. Click the 👁️ icon to reveal and copy it.
    <br><br>
    Once entered, your plugin tools (AI content writer, meta generator, FAQ builder, and image generator) will be activated instantly.
  </p>
</div>

        <div style="background-color: #FFFFFF; padding: 30px; border-radius: 10px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.9);">
            <h1 id="formTitle" style="color: #080B53; margin-bottom: 20px;">Getting Started</h1>

            <form method="post" id="diyseo_form" action="">
    <?php wp_nonce_field('diyseo_create_post', 'diyseo_nonce'); ?>
    <input type="hidden" name="action" value="diyseo_create_post" />

    <table class="form-table" style="margin: 0 auto; width: 100%;">
        <tr>
            <th scope="row" style="padding-bottom: 15px; text-align: left;">
                <label id="formInputLabelLK" for="diyseo_post_title" style="color: #080B53; font-size: 16px;">Enter License Key:</label>
            </th>
            <td style="padding-bottom: 15px;">
                <input type="text" id="lkInput" name="licenseKey" style="width: 100%; padding: 8px; border: 1px solid #EA2088; border-radius: 4px;" required />
            </td>
        </tr>
    </table>

    <p id="buttonSection" class="submit" style="text-align: left;">
        <button type="submit" id="diyseo_preview_buttonn" class="button" style="background-color: #080B53; border-color: #080B53; color: #FFFFFF; margin-right: 10px;">Activate</button>
    </p>
</form>

<a href="https://diyseo.ai/register/">
    <p id="buttonSection" class="submit" style="text-align: left;">
        <button id="diyseo_preview_buttonn" class="button" style="background-color: #080B53; border-color: #080B53; color: #FFFFFF; margin-right: 10px;">Get Key</button>
    </p>
</a>

        </div>

        <!-- Start of Feature Cards -->
        <div class="card-container">
            <!-- Card 1 -->
            <div class="feature-card">
                <div class="feature-icon">⚙️</div>
                <div class="feature-title">Automatic SEO Optimization</div>
                <div class="feature-description">
                    Generate SEO-optimized titles, descriptions, and keywords with just a click, all driven by advanced AI.
                </div>
            </div>

            <!-- Card 2 -->
            <div class="feature-card">
                <div class="feature-icon">📝</div>
                <div class="feature-title">State-of-the-Art Article Generation</div>
                <div class="feature-description">
                    Generate high-quality, SEO-optimized articles effortlessly with cutting-edge AI technology. Tailored to your specific topics and keywords, ensuring top-tier content every time.
                </div>
            </div>

            <!-- Card 3 -->
            <div class="feature-card">
                <div class="feature-icon">🖼️</div>
                <div class="feature-title">AI-Generated Images</div>
                <div class="feature-description">
                    Generate stunning featured images based on your content with our AI-powered image generation tool.
                </div>
            </div>
        </div>

        <!-- End of Feature Cards -->

        <!-- Start of Large Image Section -->
        <div class="image-section">
            <h2 class="image-section-title">All The Tools You Need</h2>
            <img src="<?php echo esc_url(plugins_url('form-screenshot.png', __FILE__)); ?>" alt="DIY SEO Plugin Forms">
                        <img src="<?php echo esc_url(plugins_url('lb-screenshot.jpg', __FILE__)); ?>" alt="DIY SEO Plugin Forms">
                                    <img src="<?php echo esc_url(plugins_url('dash.png', __FILE__)); ?>" alt="DIY SEO Plugin Forms">


        </div>
        <!-- End of Large Image Section -->

    </div>

   <?php
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['licenseKey'])) {
    if (
        isset($_POST['diyseo_nonce']) && 
        wp_verify_nonce(
            sanitize_text_field(wp_unslash($_POST['diyseo_nonce'])), 
            'diyseo_create_post'
        )
    ) {
        $licenseKey = sanitize_text_field(wp_unslash($_POST['licenseKey']));
        diyseo_show_user_info($licenseKey);
    } else {
        wp_die('Invalid nonce specified', 'Error', array('response' => 403));
    }
}
    ?>
    </body>
    </html>
    <?php
}

function diyseo_get_user_info($licenseKey) {
    $api_url = 'https://diyseoapi-69f00dabdd4f.herokuapp.com/checkPluginKey/' . urlencode($licenseKey);
    
    $response = wp_remote_get($api_url, array(
        'timeout' => 15,
        'sslverify' => true,
    ));

    if (is_wp_error($response)) {
        return false;
    }

    $body = wp_remote_retrieve_body($response);
    $user_info = json_decode($body, true);

    if (empty($user_info) || !is_array($user_info)) {
        return false;
    }

    // Store user info in WordPress
    $user_id = get_current_user_id();
    update_user_meta($user_id, 'diyseo_user_email', $user_info['email']);
    update_user_meta($user_id, 'diyseo_access_token', $licenseKey);
    update_option('diyseo_license_key', $licenseKey);

    $api_url = 'https://diyseoapi-69f00dabdd4f.herokuapp.com/subscriptioninfo/' . urlencode($user_info['email']);
    
    $response = wp_remote_get($api_url, array(
        'timeout' => 15,
        'sslverify' => true,
    ));

    if (is_wp_error($response)) {
        return false;
    }

    $body = wp_remote_retrieve_body($response);
    $user_info_sub = json_decode($body, true);

    if (empty($user_info_sub) || !is_array($user_info)) {
        return false;
    }
        update_option('diyseo_user_sub', $user_info_sub['name']);


    return $user_info;
}

function diyseo_show_user_info($licenseKey) {
    $user_info = diyseo_get_user_info($licenseKey);
    
    if ($user_info) {
        // Update WordPress options
        update_option('diyseo_license_key', $licenseKey);
        
        echo "<script>
            localStorage.setItem('diyseoLK', '" . esc_js($user_info['email']) . "');
            localStorage.setItem('diyseoLicK', '" . esc_js($licenseKey) . "');
            showActivatedDisplay(); // Call this immediately
            location.reload(); // Reload the page to ensure everything is updated
        </script>";
    } else {
        echo "<p>No user found with ID " . esc_html($licenseKey) . "</p>";
    }
}

function diyseo_ai_enqueue_admin_scripts() {
    wp_enqueue_script('diyseo-settings', plugin_dir_url(__FILE__) . 'js/diyseo-settings.js', array('jquery'), '1.0.0', true);
    
    wp_localize_script('diyseo-settings', 'diyseoAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('diyseo_ajax_nonce')
    ));
}
add_action('admin_enqueue_scripts', 'diyseo_ai_enqueue_admin_scripts');

// AJAX handler for deactivation
function diyseo_deactivate_license_handler() {
        delete_option('diyseo_license_key');

    // Verify nonce
    if (!check_ajax_referer('diyseo_ajax_nonce', 'nonce', false)) {
        wp_send_json_error(array('message' => 'Invalid security token'));
        exit;
    }

    // Check user capabilities
    if (!current_user_can('manage_options')) {
        wp_send_json_error(array('message' => 'Insufficient permissions'));
        exit;
    }

    // Perform deactivation
    
    wp_send_json_success(array('message' => 'License deactivated successfully'));
}
add_action('wp_ajax_diyseo_deactivate_license', 'diyseo_deactivate_license_handler');

?>
