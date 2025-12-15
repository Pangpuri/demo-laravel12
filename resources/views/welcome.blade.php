@extends('layouts.app')
@section('title') Welcome @parent @endsection

@section('content')
<div class="container mx-auto mt-12 px-6">
    <!-- Skills Section -->
    <div class="bg-gray-900 rounded-xl shadow-lg p-8 mb-10">
        <h2 class="text-3xl font-bold text-white mb-6">Skills</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            <div class="bg-gray-800 text-white rounded-lg p-4 text-center hover:scale-105 transition">
                Laravel & Backend
            </div>
            <div class="bg-gray-800 text-white rounded-lg p-4 text-center hover:scale-105 transition">
                React & Frontend
            </div>
            <div class="bg-gray-800 text-white rounded-lg p-4 text-center hover:scale-105 transition">
                Database Design
            </div>
            <div class="bg-gray-800 text-white rounded-lg p-4 text-center hover:scale-105 transition">
                Docker & Deployment
            </div>
            <div class="bg-gray-800 text-white rounded-lg p-4 text-center hover:scale-105 transition">
                QA & Testing
            </div>
            <div class="bg-gray-800 text-white rounded-lg p-4 text-center hover:scale-105 transition">
                Creative UI Design
            </div>
        </div>
    </div>

    <!-- Projects Section -->
    <div class="bg-gray-900 rounded-xl shadow-lg p-8">
        <h2 class="text-3xl font-bold text-white mb-6">Projects & Experience</h2>
        <div class="space-y-6">
            <div class="bg-gray-800 text-gray-200 rounded-lg p-6 hover:shadow-xl transition">
                <h3 class="text-xl font-semibold text-white">Neon Apocalypse</h3>
                <p class="mt-2">Sci-fi storefront with Hero Section, Product Grid : ->
                    <a href="https://tourmaline-quokka-fc758a.netlify.app/"> Link DemoCustom Webapplication </a>
                </p>
            </div>
            <div class="bg-gray-800 text-gray-200 rounded-lg p-6 hover:shadow-xl transition">
                <h3 class="text-xl font-semibold text-white">Laravel CRUD Dashboard</h3>
                <p class="mt-2">Reviewer-friendly CRUD system with Auth, ORM, and protected dashboard.</p>
                <p>Test funtion Login with : "admin@test.dev" , Password : "00000000"</p>
            </div>
            <div class="bg-gray-800 text-gray-200 rounded-lg p-6 hover:shadow-xl transition">
                <h3 class="text-xl font-semibold text-white">Futuristic Glassmorphism UI</h3>
                <p class="mt-2">Creative UI showcase with glowing effects and receipt system integration.</p>
            </div>
        </div>
    </div>
</div>
@endsection
