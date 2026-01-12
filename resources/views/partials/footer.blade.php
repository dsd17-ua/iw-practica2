<style>
    .site-footer {
        background: #11152a;
        color: rgba(255, 255, 255, 0.7);
    }
    .site-footer__inner {
        max-width: 72rem;
        margin: 0 auto;
        padding: 40px 24px;
        width: 100%;
    }
    .site-footer__grid {
        display: grid;
        gap: 32px;
    }
    @media (min-width: 768px) {
        .site-footer__grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }
    .site-footer__brand {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #fff;
        font-weight: 600;
        font-size: 14px;
    }
    .site-footer__icon {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 9999px;
        background: rgba(255, 255, 255, 0.1);
    }
    .site-footer__icon svg {
        width: 14px;
        height: 14px;
    }
    .site-footer__text {
        font-size: 14px;
        line-height: 1.6;
        color: rgba(255, 255, 255, 0.6);
    }
    .site-footer__title {
        font-size: 14px;
        font-weight: 600;
        color: #fff;
        margin-bottom: 12px;
    }
    .site-footer__list {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        gap: 8px;
        font-size: 14px;
        color: rgba(255, 255, 255, 0.6);
    }
    .site-footer__row {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .site-footer__divider {
        margin-top: 32px;
        padding-top: 16px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        font-size: 12px;
        color: rgba(255, 255, 255, 0.4);
    }
</style>

<footer class="site-footer">
    <div class="site-footer__inner">
        <div class="site-footer__grid">
            <div>
                <div class="site-footer__brand">
                    <span class="site-footer__icon">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 10h12M4 10v4M20 10v4M8 14h8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <span>FitZone Gym</span>
                </div>
                <p class="site-footer__text">
                    Tu centro deportivo de confianza. Alcanza tus objetivos con nosotros.
                </p>
            </div>

            <div>
                <h3 class="site-footer__title">Contacto</h3>
                <ul class="site-footer__list">
                    <li class="site-footer__row">
                        <span class="site-footer__icon">
                            <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 21s7-6.1 7-11a7 7 0 1 0-14 0c0 4.9 7 11 7 11z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </span>
                        <span>Calle Principal 123, Madrid</span>
                    </li>
                    <li class="site-footer__row">
                        <span class="site-footer__icon">
                            <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3.1-8.6A2 2 0 0 1 4 2h3a2 2 0 0 1 2 1.7c.1.9.3 1.8.6 2.7a2 2 0 0 1-.5 2.1l-1.3 1.3a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.5c.9.3 1.8.5 2.7.6A2 2 0 0 1 22 16.9z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span>+34 900 123 456</span>
                    </li>
                    <li class="site-footer__row">
                        <span class="site-footer__icon">
                            <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 5h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="m22 7-10 7L2 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span>info@fitzone.com</span>
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="site-footer__title">Horarios</h3>
                <ul class="site-footer__list">
                    <li>Lunes - Viernes: 6:00 - 23:00</li>
                    <li>Sabados: 8:00 - 21:00</li>
                    <li>Domingos: 9:00 - 15:00</li>
                </ul>
            </div>
        </div>
        <div class="site-footer__divider">
            (c) 2024 FitZone Gym. Todos los derechos reservados.
        </div>
    </div>
</footer>
