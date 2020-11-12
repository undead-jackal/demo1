<div class="sidebar">
    <!--
Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

Tip 2: you can also add an image using data-image tag
-->
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="https://www.creative-tim.com/" class="simple-text logo-mini"></a>
            <a href="https://www.creative-tim.com/" class="simple-text logo-normal">
              E-nroll
            </a>
        </div>
        <ul class="nav">
        <?php

        $content = array(
          array(
            "text" => "Enroll",
            "link" => route_to("Enroll"),
            "icon" => "fas fa-folder"

          ),
          array(
            "text" => "My Studyload",
            "link" => route_to("result"),
            "icon" => "fas fa-address-card"
          ),
          array(
            "text" => "Logout",
            "link" => route_to("logout"),
            "icon" => "nc-icon nc-button-power"
          ),

        );
        echo sidebar_content($content);

        ?>
        </ul>
    </div>
</div>
