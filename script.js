document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('modal');
    const openBtn = document.getElementById('btn');
    const closeBtn = document.getElementById('closeModal');
    const loginForm = document.getElementById('loginForm');

    openBtn.addEventListener('click', () => {
        modal.classList.add('show');
    });

    closeBtn.addEventListener('click', () => {
        modal.classList.remove('show');
    });

    loginForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();

        if (!email || !password) {
            alert('Please fill in both email and password.');
            return;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert('Please enter a valid email address.');
            return;
        }

        modal.classList.remove('show');
        loginForm.reset();
    });
});
