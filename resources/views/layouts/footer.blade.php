<footer id="footer">
    <div class="container py-footer">
        <div class="row">
            <div
                class="col-12 col-sm-6 col-md-12 col-lg-3 text-center text-sm-start text-md-center text-lg-start mb-5 mb-lg-0">
                <img src="{{ asset('img/logo.png') }}" width="60px" alt="Logo footer">
                <p class="mt-10 font-inter fw-medium text-color-80"><i class="las la-copyright"></i><span id="copyright-year">2023</span> Kpop
                    Soulmate,
                    All
                    Rights Reserved.
                </p>
            </div>
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                <h4 class="mb-3 fw-bold text-color-100">More Information</h4>
                <ul>
                    <li class="mb-10"><a href="{{ route('about-us') }}" class="text-decoration-none">About Us </a></li>
                    <li class="mb-10"><a href="{{ route('discography-explore') }}" class="text-decoration-none">Explore Album</a></li>
                    {{-- <li class="mb-10"><a href="" class="text-decoration-none">Tutorials </a></li> --}}
                    <li class="mb-10"><a href="{{ route('privacy-and-policy') }}" class="text-decoration-none">Privacy & Policy </a></li>
                    <li><a href="{{ route('terms-and-conditions') }}" class="text-decoration-none">Terms & Conditions </a></li>
                </ul>
            </div>
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                <h4 class="mb-3 fw-bold text-color-100">Support Us</h4>
                <ul>
                    <li class="mb-10"><a href="https://www.youtube.com/@KpopSoulmate"
                            target="_blank" class="text-decoration-none">Subscribe on
                            Youtube </a></li>
                    <li class="mb-10"><a href="https://www.paypal.com/paypalme/kpopsoulmate" target="_blank"
                            class="text-decoration-none">Paypal</a>
                    </li>
                    <li class="mb-10"><a href="https://saweria.co/kpopsoulmate" target="_blank"
                            class="text-decoration-none">Saweria (Indonesia Supporter)</a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <h4 class="mb-3 fw-bold text-color-100">Get In Touch</h4>
                <a href="mailto:bgkfuntastic@gmail.com" class="text-decoration-none text-color-80" aria-label="Link to contact us via email">
                    <i class='bx bxl-gmail bx-sm mr-15'></i>
                </a>
                <a href="https://discord.gg/W5Serw289E" class="text-decoration-none text-color-80" aria-label="Link to discord server"><i
                        class='bx bxl-discord-alt bx-sm mr-15'></i>
                </a>
                <a href="https://open.spotify.com/user/8y2ow34d7bxgklpo638ovxv8v?si=99fb9ff306654772" class="text-decoration-none text-color-80" aria-label="Link to Kpop Soulmate Spotify List"><i class='bx bxl-spotify bx-sm'></i>
                </a>
            </div>
        </div>
    </div>
</footer>
