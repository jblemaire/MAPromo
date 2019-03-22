@guest
    @include('includes.login')
    @include('includes.register')
@else
    <input id="userInfos" type="hidden" value="{{Auth::user()}}"/>
@endguest
<!-- Footer -->
<footer>
    <!-- Grid row-->
    <div class="footer1 row">
        <div class="col">
            <!-- Facebook -->
            <a class="fb-ic" href="#">
                <i class="fab fa-facebook-f fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
            </a>
            <!-- Twitter -->
            <a class="tw-ic" href="#">
                <i class="fab fa-twitter fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
            </a>
            <!--Linkedin -->
            <a class="li-ic" href="#">
                <i class="fab fa-linkedin-in fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
            </a>
            <!--Instagram-->
            <a class="ins-ic" href="#">
                <i class="fab fa-instagram fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
              </a>
            </div>
        </div>
          <!-- Grid column -->
      <div class="footer2">
        <img class="logo_footer" src="{{ asset('img/logoFinal.png') }}" alt="logo">
    </div>
    <div class="row footer3">

        <!-- Grid column -->
        <div class="col">
            <a href="#"><p>Mentions Légales</p></a>
        </div>
        <div class="col">
            <a href="#"><p>Confidentialité</p></a>
        </div>
        <div class="col">
            <a href="#"><p>Conditions générales d'utilisation</p></a>
        </div>

        <!-- Grid row-->
    </div>
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2019 Copyright:
        <a href="https://mapromo.alwaysdata.net/">mapromo.alwaysdata.net/</a>
    </div>

</footer>
<!-- Footer -->
