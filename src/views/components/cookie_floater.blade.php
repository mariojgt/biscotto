<style>
    .cookie-float {
        position: fixed;
        bottom: 1.5rem;
        right: 1.5rem;
        z-index: 40;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0.75rem;
        border-radius: 0.75rem;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        opacity: 0;
        transform: translateY(1rem);
    }

    @media (prefers-color-scheme: light) {
        .cookie-float {
            background-color: #2563eb;
            color: white;
            box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2), 0 2px 4px -1px rgba(37, 99, 235, 0.1);
        }

        .cookie-float:hover {
            background-color: #1d4ed8;
            box-shadow: 0 8px 12px -3px rgba(37, 99, 235, 0.25), 0 4px 6px -2px rgba(37, 99, 235, 0.15);
            transform: translateY(-2px);
        }
    }

    @media (prefers-color-scheme: dark) {
        .cookie-float {
            background-color: #3b82f6;
            color: white;
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3), 0 2px 4px -1px rgba(59, 130, 246, 0.2);
        }

        .cookie-float:hover {
            background-color: #2563eb;
            box-shadow: 0 8px 12px -3px rgba(59, 130, 246, 0.35), 0 4px 6px -2px rgba(59, 130, 246, 0.25);
            transform: translateY(-2px);
        }
    }

    .cookie-float.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .cookie-float.dimmed {
        opacity: 0.6;
    }

    .cookie-float svg {
        width: 1.5rem;
        height: 1.5rem;
        transition: transform 0.3s ease;
    }

    .cookie-float:hover svg {
        transform: rotate(-10deg);
    }

    @keyframes float {
        0% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-5px);
        }

        100% {
            transform: translateY(0px);
        }
    }

    .cookie-float.animate {
        animation: float 3s ease-in-out infinite;
    }
</style>

<button class="cookie-float" id="cookie_popup" onclick="showCookie()" onmouseover="onCookiePopup()"
    onmouseout="offCookiePopup()" aria-label="Cookie Settings">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
        stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 2a10 10 0 1 0 10 10 4 4 0 0 1-5-5 4 4 0 0 1-5-5" />
        <path d="M8.5 8.5v.01" />
        <path d="M16 15.5v.01" />
        <path d="M12 12v.01" />
        <path d="M11 17v.01" />
        <path d="M7 14v.01" />
    </svg>
</button>

<script>
    function onCookiePopup() {
        const button = document.querySelector('#cookie_popup');
        button.classList.remove('dimmed');
        button.classList.add('visible');
    }

    function offCookiePopup() {
        const button = document.querySelector('#cookie_popup');
        button.classList.add('dimmed');
    }

    function enableCookie() {
        const button = document.querySelector('#cookie_popup');
        button.classList.add('visible', 'animate', 'dimmed');
    }

    // Initialize the floating button
    setTimeout(() => {
        enableCookie();
    }, 1000);
</script>
