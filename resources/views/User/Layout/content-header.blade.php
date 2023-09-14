 {{-- content header --}}
 <div class="container-fluid bg-blue text-white pt-3">
     <div class="container pb-5">
         <div class="row gap-2">
             <div class="col-sm order-sm-2">
                 <img src="{{ asset('User/assets/images/banner.jpg') }}" class="img-fluid banner-img banner-img"
                     alt="banner-image" height="200">
             </div>
             <div class="col-sm order-sm-1">
                 <h1 class="h1">
                     @auth
                         Hi {{ auth()->user()->name }},
                     @endauth
                     Have a Medical Question?</h1>
                 <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsa nesciunt repellendus itaque,
                     laborum
                     saepe
                     enim maxime, delectus, dicta cumque error cupiditate nobis officia quam perferendis
                     consequatur
                     cum
                     iure
                     quod facere.</p>
             </div>
         </div>
     </div>
 </div>
