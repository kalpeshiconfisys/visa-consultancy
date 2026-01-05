<style>
    /* Avatar Wrapper */
    .avatar-wrapper {
        position: relative;
    }

    /* Avatar Circle */
    .avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        padding: 2px;
        background: linear-gradient(135deg, #4A90E2, #8E2DE2);
        cursor: pointer;
        transition: .25s ease;
        box-shadow: 0 8px 25px rgba(0, 0, 0, .25);
        position: relative;
    }

    .avatar img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 3px solid #fff;
        object-fit: cover;
    }

    .avatar:hover {
        transform: scale(1.08);
        box-shadow: 0 12px 30px rgba(0, 0, 0, .35);
    }

    /* Online Dot */
    .avatar::after {
        content: "";
        position: absolute;
        right: 0;
        bottom: 0;
        width: 11px;
        height: 11px;
        border-radius: 50%;
        background: #00c853;
        border: 2px solid white;
    }

    /* Dropdown */
    .dropdown {
        position: absolute;
        right: 0;
        margin-top: 12px;
        min-width: 190px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(12px);
        border-radius: 10px;
        box-shadow: 0 25px 45px rgba(0, 0, 0, .25);
        padding: 10px;
        display: none;
        flex-direction: column;
        animation: fade .25s ease;
    }

    @keyframes fade {
        from {
            opacity: 0;
            transform: translateY(8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown a {
        text-decoration: none;
        color: #333;
        padding: 8px 10px;
        border-radius: 7px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: .2s ease;
    }

    .dropdown a:hover {
        background: #eef1ff;
        color: #4A63FF;
        padding-left: 14px;
    }

    .dropdown i {
        font-size: 18px;
        width: 20px;
        text-align: center;
        color: #4a63ff;
    }

    .dropdown .text-danger i {
        color: #ff3d3d;
    }
</style>


<div class="header">
    <div class="d-flex align-items-center justify-content-between w-100">
        <div class="d-flex align-items-center" style="gap:20px;">
            <button class="sidebar-toggle" id="sidebarToggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
        <div class="icon-group">
            <div class="avatar-wrapper">
                <div class="avatar" id="avatarBtn">
                    <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png">
                </div>
                <div class="dropdown" id="dropdownMenu">
                    <a href="{{ url('admin/logout') }}" class="text-danger">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="search-bar-dropdown">
    <div class="d-flex align-center">
        <span class="material-symbols-outlined">search</span>
        <input type="text" placeholder="Search People">
    </div>
</div>

<script>
    $(function() {

        // Sidebar open
        $('#sidebarToggle').on('click', function() {
            $('.sidebar').addClass('open');
            $('body').addClass('sidebar-open');
            $('.sidebar-overlay').show();
        });

        // Sidebar close (icon)
        $('.sidebar-close').on('click', function() {
            $('.sidebar').removeClass('open');
            $('body').removeClass('sidebar-open');
            $('.sidebar-overlay').hide();
        });

        // Sidebar close (overlay)
        $('.sidebar-overlay').on('click', function() {
            $('.sidebar').removeClass('open');
            $('body').removeClass('sidebar-open');
            $(this).hide();
        });

    });

    // Avatar dropdown
    const avatarBtn = document.getElementById('avatarBtn');
    const dropdownMenu = document.getElementById('dropdownMenu');

    avatarBtn.addEventListener('click', () => {
        dropdownMenu.style.display =
            dropdownMenu.style.display === 'flex' ? 'none' : 'flex';
    });

    document.addEventListener('click', (e) => {
        if (!avatarBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.style.display = 'none';
        }
    });
</script>
