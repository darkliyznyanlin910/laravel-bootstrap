@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header bg-dark text-white"><b>About this project</b></div>

                <div class="row card-body">
                    <div class="col-3">
                        <img class="w-100" src="images/profile.jpg">
                    </div>
                    <div class="col-9">
                        <p>Hello, my name is Johnny. I started of this project as a part of school assignment. However, 
                        I wanted to make the project better and started adding in more than what's required by the 
                        assignment. It's was quite fun creating a website and trying to learn new things.</p>

                        <p>My Social Media :
                
                        <a class="btn btn-outline-dark btn-floating m-1" target="_blank" href="https://www.facebook.com/kaungnyan.lin.75/" role="button"
                            ><i class="fa fa-facebook"></i
                        ></a>

                        <a class="btn btn-outline-dark btn-floating m-1" target="_blank" href="https://www.instagram.com/johnny_knl/" role="button"
                            ><i class="fa fa-instagram"></i
                        ></a>

                        <a class="btn btn-outline-dark btn-floating m-1" target="_blank" href="https://www.linkedin.com/in/kaung-nyan-lin/" role="button"
                            ><i class="fa fa-linkedin"></i
                        ></a>

                        <a class="btn btn-outline-dark btn-floating m-1" target="_blank" href="https://app.hackthebox.com/profile/637528" role="button"
                            ><span class="iconify" data-icon="simple-icons:hackthebox"></span></i
                        ></a></p>

                        <p><b>Resources used in this Project</b></p>
                        <ul>
                            <li>Framework - <a target="_blank" href="https://laravel.com/">Laravel</a></li>
                            <li>UI/CSS - <a target="_blank" href="https://getbootstrap.com/">Bootstrap 5</a></li>
                            <li>Icons - <a target="_blank" href="https://fontawesome.com/">Font Awesome SVGs</a></li>
                            <li>Paypal Sandbox API - <a target="_blank" href="https://github.com/srmklive/laravel-paypal">srmklive/laravel-paypal</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row pt-3">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header bg-dark text-white"><b>My Other Activities</b></div>

                <div class="row card-body">
                    <div class="col-3">
                        <img class="w-100" src="images/lol.jpg">
                        <img class="w-100" src="images/logo-htb.png">
                    </div>
                    <div class="col-6">
                        <p>I love hacking too. I participated in quite a lot of 'Capture the Flag' challenges such as DSTA2021 and HTXIC2021.</p>
                        
                        <p>I also have a public profile on <a target="_blank" href="https://app.hackthebox.com/profile/637528">Hackthebox</a>.</p>
                        <p><b>My Hackthebox Stats</b> (as of 12 Feb 2022)</p>
                        <ul>
                            <li>Ranking - 525</li>
                            <li>Points - 131</li>
                            <li>User Owns - 18</li>
                            <li>System Owns - 16</li>
                        </ul>
                    </div>
                    <div class="col-3">
                        <img class="w-100" src="images/dsta.jpg">
                        <img class="w-100" src="images/htx.jpg">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection