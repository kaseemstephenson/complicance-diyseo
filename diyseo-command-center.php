<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Add the Command Center admin page
add_action('admin_menu', function () {
    add_submenu_page(
        'diyseo_settings_page',                       // parent slug (from diyseo.php)
        'Command Center',              // page title
        'Command Center',              // menu title
        'manage_options',              // capability
        'diyseo-command-center',       // menu slug
        'diyseo_render_command_center' // callback
    );
});

// Render the Command Center page
function diyseo_render_command_center() {
    $user_email = get_user_meta(get_current_user_id(), 'diyseo_user_email', true);

    if (!$user_email) {
        echo '<div class="notice notice-error"><p>❌ Please activate your DIYSEO license key to use the Command Center.</p></div>';
        return;
    }
    echo '<meta name="diyseo-user-email" content="' . esc_attr($user_email) . '">';


    ?>
    <style>
        html, body {
            background: #0b0c2a !important;
        }
        .wrap h1, h2, h3, label, span, p, div, input, textarea {
            color: #f2f2f2 !important;
        }

        #diyseo-command-center-root {
            padding: 30px;
        }

        .diyseo-header-bar {
            text-align: center;
            margin-bottom: 40px;
        }

        .diyseo-logo {
            width: 160px;
            margin: 0 auto 10px;
            display: block;
        }

        .diyseo-nav {
            font-size: 18px;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.08);
            padding: 10px 24px;
            border-radius: 12px;
            display: inline-block;
            color: white;
            box-shadow: 0 4px 12px rgba(255, 0, 255, 0.1);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(18px) saturate(160%);
            -webkit-backdrop-filter: blur(18px) saturate(160%);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 20px;
            margin-bottom: 30px;
        }

        .card-row {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
        }

        input[type="text"],
        input[type="file"],
        textarea {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            color: white;
            padding: 8px 12px;
            width: 100%;
            margin-bottom: 12px;
            font-size: 14px;
        }

        input::placeholder,
        textarea::placeholder {
            color: #ccc;
        }

        button {
            background: linear-gradient(135deg, #d127ff, #9740ff);
            color: white;
            border: none;
            padding: 8px 16px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.2s ease-in-out;
        }

        button:hover {
            background: linear-gradient(135deg, #b700ff, #8126e0);
        }

        #cc-item-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #cc-item-list li {
            background: rgba(255, 255, 255, 0.05);
            padding: 10px 14px;
            border-radius: 10px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            color: #fff;
        }

        #cc-item-list button {
            background: transparent;
            color: #ff5e5e;
            border: none;
            font-size: 14px;
            cursor: pointer;
        }
    </style>

    <div id="diyseo-command-center-root">
        <div class="diyseo-header-bar">
            <img class="diyseo-logo" src="<?php echo esc_url(plugins_url('logo.png', __FILE__)); ?>" alt="DIYSEO Logo">
            <div class="diyseo-nav">Command Center</div>
        </div>
        <div class="diyseo-info-section" style="margin-bottom: 30px; padding: 20px; border-radius: 12px; background: rgba(255,255,255,0.03); color: #ddd;">
  <h2 style="color: #fff; font-size: 22px; margin-bottom: 10px;">🧠 What is the DIYSEO Command Center?</h2>
  <p style="line-height: 1.6;">
    The Command Center is your personal workspace to store helpful notes and upload reference files. These items are used by the plugin’s AI tools (article writer, meta generator, FAQ creator, etc.) to produce smarter, more personalized content.
  </p>
  <p style="margin-top: 10px;">
    Add a note to guide tone or strategy, or upload PDFs and CSVs with key info. When you generate content, we automatically pull in your Command Center context for better results.
  </p>
</div>


        <div class="glass-card">
            <h2>📁 Your Command Center</h2>
            <ul id="cc-item-list">
                <li>Loading...</li>
            </ul>
        </div>

        <div class="card-row">
            <div class="glass-card" style="flex: 1">
               <h3>📎 Upload File</h3>
<p style="color: #ccc; font-size: 13px; margin: -10px 0 10px;">Supported file types: <code>.pdf</code>, <code>.csv</code></p>
<form id="cc-upload-form">

                    <input type="file" name="file" accept=".pdf,.docx" required />
                    <input type="text" name="title" placeholder="Title for file..." required />
                    <button type="submit">Upload</button>
                </form>
            </div>

            <div class="glass-card" style="flex: 1">
                <h3>🧠 Add Note</h3>
                <form id="cc-note-form">
                    <input type="text" name="title" placeholder="Note title..." required />
                    <textarea name="content" placeholder="Write your instruction..." rows="6" required></textarea>
                    <button type="submit">Save Note</button>
                </form>
            </div>
        </div>
    </div>
    <?php
}



// Enqueue CSS + JS
add_action('admin_enqueue_scripts', function ($hook) {
    if (strpos($hook, 'diyseo-command-center') === false) return;

    wp_enqueue_style('diyseo-command-center-css', plugin_dir_url(__FILE__) . 'css/diyseo-command-center.css');
    wp_enqueue_script('diyseo-command-center-js', plugin_dir_url(__FILE__) . 'js/diyseo-command-center.js', ['jquery'], null, true);

    wp_localize_script('diyseo-command-center-js', 'DIYSEO_CC', [
        'api' => 'https://diyseoapi-69f00dabdd4f.herokuapp.com/api/command-center',
        'email' => get_user_meta(get_current_user_id(), 'diyseo_user_email', true)
    ]);
});
