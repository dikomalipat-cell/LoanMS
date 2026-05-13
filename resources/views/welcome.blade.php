<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LoanMS - Premium Loan Management System</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700|outfit:400,500,600,700,800" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-heading { font-family: 'Outfit', sans-serif; }
        .bg-primary-dark { background-color: #0f172a; } /* Slate 900 */
        .bg-primary { background-color: #1e293b; } /* Slate 800 */
        .bg-primary-light { background-color: #334155; } /* Slate 700 */
        .text-gold { color: #f5c518; }
        .bg-gold { background-color: #f5c518; }
        .border-gold { border-color: #f5c518; }
        .hover-bg-gold:hover { background-color: #eab308; } /* Yellow 500 */
        .text-gold-light { color: #fef08a; } /* Yellow 200 */
        
        /* Glassmorphism */
        .glass {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="antialiased bg-primary-dark text-slate-300 selection:bg-gold selection:text-slate-900">
    
    <!-- Navbar -->
    <nav class="fixed w-full z-50 glass transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-gold flex items-center justify-center shadow-[0_0_15px_rgba(245,197,24,0.4)]">
                        <i class="fas fa-coins text-primary-dark text-xl"></i>
                    </div>
                    <span class="font-heading font-bold text-2xl tracking-tight text-white">Loan<span class="text-gold">MS</span></span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="text-slate-300 hover:text-gold transition font-medium">Features</a>
                    <a href="#how-it-works" class="text-slate-300 hover:text-gold transition font-medium">How it Works</a>
                    <a href="#testimonials" class="text-slate-300 hover:text-gold transition font-medium">Testimonials</a>
                </div>
                
                <div class="hidden md:flex items-center space-x-4">
                    @if (Route::has('admin.login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-medium text-slate-300 hover:text-white transition"></a>
                        @else
                            <a href="{{ route('profile.login') }}" class="font-medium text-slate-300 hover:text-white transition">Log in</a>
                            
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-full bg-gold hover-bg-gold text-primary-dark font-semibold transition shadow-[0_4px_14px_0_rgba(245,197,24,0.39)] hover:shadow-[0_6px_20px_rgba(245,197,24,0.23)] hover:-translate-y-0.5 transform duration-200">
                                    Get Started
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button class="text-slate-300 hover:text-white focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <!-- Abstract Background Shapes -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[1000px] h-[500px] opacity-20 pointer-events-none">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-gold blur-[100px] rounded-full mix-blend-screen"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-gold/30 bg-gold/10 text-gold mb-8">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-gold opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-gold"></span>
                    </span>
                    <span class="text-sm font-medium tracking-wide uppercase">The Future of Lending</span>
                </div>
                
                <h1 class="text-5xl md:text-7xl font-heading font-extrabold text-white leading-tight mb-6">
                    Empowering Your <br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-gold to-yellow-200">Financial Growth</span>
                </h1>
                
                <p class="mt-4 text-xl text-slate-400 max-w-2xl mx-auto mb-10 leading-relaxed">
                    A premium, secure, and intuitive platform designed to streamline loan management, approvals, and tracking for both lenders and borrowers.
                </p>
                
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('profile.login') }}" class="px-8 py-4 rounded-full bg-gold hover-bg-gold text-primary-dark font-bold text-lg transition shadow-[0_0_20px_rgba(245,197,24,0.4)] hover:shadow-[0_0_30px_rgba(245,197,24,0.6)] hover:-translate-y-1 transform duration-300 flex items-center justify-center gap-2">
                        Apply for a Loan <i class="fas fa-arrow-right"></i>
                    </a>
                    <a href="#features" class="px-8 py-4 rounded-full bg-primary border border-slate-600 hover:border-gold hover:text-gold text-white font-semibold text-lg transition duration-300 flex items-center justify-center">
                        Explore Features
                    </a>
                </div>
            </div>
            
            <!-- Dashboard Preview Mockup -->
            <div class="mt-20 relative mx-auto max-w-5xl perspective-1000">
                <div class="rounded-2xl border border-slate-700 bg-primary shadow-2xl overflow-hidden transform rotate-x-12 translate-y-4 hover:rotate-x-0 hover:translate-y-0 transition-all duration-700 ease-out shadow-[0_20px_50px_rgba(0,0,0,0.5)]">
                    <!-- Browser Chrome -->
                    <div class="bg-primary-dark px-4 py-3 border-b border-slate-700 flex items-center gap-2">
                        <div class="flex gap-2">
                            <div class="w-3 h-3 rounded-full bg-red-500"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                            <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        </div>
                        <div class="mx-auto bg-primary rounded-md px-32 py-1 text-xs text-slate-500 flex items-center gap-2">
                            <i class="fas fa-lock text-[10px]"></i> app.loanms.com
                        </div>
                    </div>
                    <!-- App Content Fake -->
                    <div class="flex h-64 md:h-96">
                        <!-- Sidebar -->
                        <div class="w-1/4 border-r border-slate-700 p-4 hidden md:block">
                            <div class="flex items-center gap-2 mb-8">
                                <div class="w-6 h-6 rounded bg-gold flex items-center justify-center"><i class="fas fa-coins text-[10px] text-primary-dark"></i></div>
                                <div class="h-4 w-20 bg-slate-600 rounded"></div>
                            </div>
                            <div class="space-y-4">
                                <div class="h-8 w-full bg-gold/20 rounded-md"></div>
                                <div class="h-8 w-3/4 bg-primary-light rounded-md"></div>
                                <div class="h-8 w-5/6 bg-primary-light rounded-md"></div>
                                <div class="h-8 w-4/6 bg-primary-light rounded-md"></div>
                            </div>
                        </div>
                        <!-- Main Content -->
                        <div class="flex-1 p-6">
                            <div class="h-6 w-48 bg-slate-600 rounded mb-8"></div>
                            <div class="grid grid-cols-3 gap-4 mb-8">
                                <div class="h-24 bg-primary-light rounded-xl border border-slate-700 p-4 flex flex-col justify-between relative overflow-hidden">
                                    <div class="h-3 w-16 bg-slate-500 rounded"></div>
                                    <div class="h-6 w-24 bg-gold rounded"></div>
                                    <div class="absolute right-0 top-0 w-16 h-16 bg-gold/10 rounded-bl-full"></div>
                                </div>
                                <div class="h-24 bg-primary-light rounded-xl border border-slate-700 p-4 flex flex-col justify-between">
                                    <div class="h-3 w-20 bg-slate-500 rounded"></div>
                                    <div class="h-6 w-16 bg-white rounded"></div>
                                </div>
                                <div class="h-24 bg-primary-light rounded-xl border border-slate-700 p-4 flex flex-col justify-between">
                                    <div class="h-3 w-24 bg-slate-500 rounded"></div>
                                    <div class="h-6 w-20 bg-white rounded"></div>
                                </div>
                            </div>
                            <div class="h-32 bg-primary-light rounded-xl border border-slate-700"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Floating Elements -->
                <div class="absolute -left-10 top-1/4 w-24 h-24 bg-primary border border-slate-600 rounded-xl shadow-lg flex flex-col items-center justify-center gap-2 animate-bounce" style="animation-duration: 3s;">
                    <i class="fas fa-check-circle text-green-400 text-2xl"></i>
                    <span class="text-xs font-semibold text-white">Approved</span>
                </div>
                <div class="absolute -right-5 bottom-1/4 w-32 h-16 bg-primary border border-slate-600 rounded-xl shadow-lg flex items-center gap-3 px-3 animate-bounce" style="animation-duration: 4s; animation-delay: 1s;">
                    <div class="w-8 h-8 rounded-full bg-gold/20 flex items-center justify-center text-gold"><i class="fas fa-bell"></i></div>
                    <div class="flex flex-col">
                        <span class="text-[10px] text-slate-400">Payment Due</span>
                        <span class="text-xs font-bold text-white">Today</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="features" class="py-24 bg-primary relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-gold font-semibold tracking-wide uppercase text-sm mb-2">Why Choose Us</h2>
                <h3 class="text-3xl md:text-4xl font-heading font-bold text-white mb-4">Everything you need to manage loans</h3>
                <p class="text-slate-400 max-w-2xl mx-auto">Our platform provides enterprise-grade features wrapped in a beautiful, intuitive interface.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-primary-dark p-8 rounded-2xl border border-slate-700 hover:border-gold/50 transition-colors duration-300 group">
                    <div class="w-14 h-14 rounded-xl bg-primary flex items-center justify-center mb-6 group-hover:bg-gold transition-colors duration-300">
                        <i class="fas fa-bolt text-2xl text-gold group-hover:text-primary-dark transition-colors duration-300"></i>
                    </div>
                    <h4 class="text-xl font-heading font-bold text-white mb-3">Fast Approvals</h4>
                    <p class="text-slate-400 leading-relaxed">Streamlined workflows allow staff and admins to review, verify, and approve loan applications in record time.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-primary-dark p-8 rounded-2xl border border-slate-700 hover:border-gold/50 transition-colors duration-300 group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gold/5 rounded-bl-full -z-10 transition-transform group-hover:scale-110"></div>
                    <div class="w-14 h-14 rounded-xl bg-primary flex items-center justify-center mb-6 group-hover:bg-gold transition-colors duration-300">
                        <i class="fas fa-shield-alt text-2xl text-gold group-hover:text-primary-dark transition-colors duration-300"></i>
                    </div>
                    <h4 class="text-xl font-heading font-bold text-white mb-3">Bank-Grade Security</h4>
                    <p class="text-slate-400 leading-relaxed">Your financial data is protected with state-of-the-art encryption, secure sessions, and comprehensive audit logs.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-primary-dark p-8 rounded-2xl border border-slate-700 hover:border-gold/50 transition-colors duration-300 group">
                    <div class="w-14 h-14 rounded-xl bg-primary flex items-center justify-center mb-6 group-hover:bg-gold transition-colors duration-300">
                        <i class="fas fa-chart-pie text-2xl text-gold group-hover:text-primary-dark transition-colors duration-300"></i>
                    </div>
                    <h4 class="text-xl font-heading font-bold text-white mb-3">Real-time Analytics</h4>
                    <p class="text-slate-400 leading-relaxed">Interactive dashboards provide deep insights into revenue, active loans, defaults, and overall financial health.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="py-20 border-y border-slate-800 bg-primary-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl md:text-5xl font-heading font-bold text-white mb-2">₱50M+</div>
                    <div class="text-slate-400 text-sm font-medium uppercase tracking-wider">Loans Disbursed</div>
                </div>
                <div>
                    <div class="text-4xl md:text-5xl font-heading font-bold text-gold mb-2">99%</div>
                    <div class="text-slate-400 text-sm font-medium uppercase tracking-wider">Repayment Rate</div>
                </div>
                <div>
                    <div class="text-4xl md:text-5xl font-heading font-bold text-white mb-2">24h</div>
                    <div class="text-slate-400 text-sm font-medium uppercase tracking-wider">Avg. Approval Time</div>
                </div>
                <div>
                    <div class="text-4xl md:text-5xl font-heading font-bold text-gold mb-2">10k+</div>
                    <div class="text-slate-400 text-sm font-medium uppercase tracking-wider">Active Borrowers</div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-gold/5"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h2 class="text-4xl font-heading font-bold text-white mb-6">Ready to take control of your finances?</h2>
            <p class="text-xl text-slate-400 mb-10">Join thousands of users who trust LoanMS for their borrowing and lending needs.</p>
            <a href="{{ route('profile.login') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-gold hover-bg-gold text-primary-dark font-bold text-lg transition shadow-lg hover:-translate-y-1 transform duration-300">
                Create an Account <i class="fas fa-user-plus"></i>
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-primary border-t border-slate-800 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 mb-12">
                <div class="col-span-2 md:col-span-1">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 rounded bg-gold flex items-center justify-center">
                            <i class="fas fa-coins text-primary-dark"></i>
                        </div>
                        <span class="font-heading font-bold text-xl text-white">Loan<span class="text-gold">MS</span></span>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed mb-4">Providing innovative financial solutions and loan management systems for modern businesses and individuals.</p>
                    <div class="flex gap-4">
                        <a href="#" class="text-slate-400 hover:text-gold transition"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-slate-400 hover:text-gold transition"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-slate-400 hover:text-gold transition"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-white font-semibold mb-4">Product</h4>
                    <ul class="space-y-2 text-sm text-slate-400">
                        <li><a href="#" class="hover:text-gold transition">Features</a></li>
                        <li><a href="#" class="hover:text-gold transition">Pricing</a></li>
                        <li><a href="#" class="hover:text-gold transition">Security</a></li>
                        <li><a href="#" class="hover:text-gold transition">Updates</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white font-semibold mb-4">Company</h4>
                    <ul class="space-y-2 text-sm text-slate-400">
                        <li><a href="#" class="hover:text-gold transition">About Us</a></li>
                        <li><a href="#" class="hover:text-gold transition">Careers</a></li>
                        <li><a href="#" class="hover:text-gold transition">Contact</a></li>
                        <li><a href="#" class="hover:text-gold transition">Partners</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2 text-sm text-slate-400">
                        <li><a href="#" class="hover:text-gold transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-gold transition">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-gold transition">Cookie Policy</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-slate-500 text-sm">© {{ date('Y') }} LoanMS. All rights reserved.</p>
                <div class="flex items-center gap-2 text-sm text-slate-500">
                    Made with <i class="fas fa-heart text-red-500"></i> using Laravel
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Simple navbar scroll effect
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 20) {
                nav.classList.add('shadow-lg');
                nav.style.background = 'rgba(15, 23, 42, 0.9)'; // Darker on scroll
            } else {
                nav.classList.remove('shadow-lg');
                nav.style.background = 'rgba(30, 41, 59, 0.7)'; // Lighter glass at top
            }
        });
    </script>
</body>
</html>
