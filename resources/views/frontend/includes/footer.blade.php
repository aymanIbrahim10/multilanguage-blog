 <!-- Footer Start -->
 <div class="container-fluid bg-light pt-5 px-sm-3 px-md-5">
     <div class="row">
         <div class="col-lg-6 col-md-6 mb-5">
             <a href="{{ route('frontend') }}" class="navbar-brand">
                 <h1 class="mb-2 mt-n2 display-5 text-uppercase"><span class="text-primary">
                         <img src="{{ asset($setting->logo) }}" style="width: 50px; height : 50px; ">
                 </h1>
             </a>
             <p>{{ $setting->translate(app()->getlocale())->describtion }}</p>
             <div class="d-flex justify-content-start mt-4">
                 @if ($setting->facebook != '')
                     <a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 38px; height: 38px;"
                         href="#"><i class="fab fa-facebook-f"></i></a>
                 @endif
                 @if ($setting->instagram != '')
                     <a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 38px; height: 38px;"
                         href="#"><i class="fab fa-instagram"></i></a>
                 @endif

             </div>
         </div>
         <div class="col-lg-6 col-md-6 mb-5">
             <h4 class="font-weight-bold mb-4">{{ __('words.categories') }}</h4>
             <div class="d-flex flex-wrap m-n1">
                 @foreach ($categories as $category)
                     <a href="{{ Route('category.frontend', $category->id) }}"
                         class="btn btn-sm btn-outline-secondary m-1">{{ $category->title }}</a>
                 @endforeach
             </div>
         </div>

     </div>
 </div>
 <div class="container-fluid py-4 px-sm-3 px-md-5">
     <p class="m-0 text-center">
         <a class="font-weight-bold" href="#">{{ __('words.Your Site Name') }}</a> .
         {{ __('words.All Rights Reserved') }} &copy;

         <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
         {{ __('words.Designed by') }} <a class="font-weight-bold" href="#">{{ __('words.zoll aghbash') }}</a>
     </p>
 </div>
 <!-- Footer End -->
