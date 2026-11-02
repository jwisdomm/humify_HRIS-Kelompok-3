<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>

    <main class="flex min-h-screen">
        <section class="flex-3 flex flex-col tall:gap-20 gap-12 pt-15 pb-10 px-15 bg-brand min-h-full">
            <div class="flex gap-2.5">
                <img src="img/logo.png" alt="Logo" class="h-8 w-8">
                <span class="text-2xl font-bold text-white">Humify</span>
            </div>
            <div class="flex flex-col gap-6">
                <span class="text-[#99F6E4] text-xs font-semibold">PEOPLE | CLARITY | EVERY DAY</span>
                <span class="text-white text-5xl font-semibold">A clearer view of your workday.</span>
                <span class="text-[#B9D5D2] font-normal text-[17px]">Your people, attendance and requests. Connected in
                    one thoughtful workspace.</span>
            </div>
            <div class="flex flex-col gap-5 p-7 rounded-xl bg-white/[5.1%]">
                <div class="flex gap-4">
                    <x-bi-clipboard-check class="text-white w-5.5 h-5.5" />
                    <div class="flex flex-col gap-1.25">
                        <span class="text-white font-semibold text-sm">Review with confidence</span>
                        <span class="text-[#B9D5D2]">Keep attendance and approvals moving.</span>
                    </div>
                </div>
                <div class="flex gap-4">
                    <x-bi-people class="text-white w-5.5 h-5.5" />
                    <div class="flex flex-col gap-1.25">
                        <span class="text-white font-semibold text-sm">People, in one place</span>
                        <span class="text-[#B9D5D2]">Find the details that help your team work.</span>
                    </div>
                </div>

            </div>
            <span class="text-[#B9D5D2] text-xs font-normal">Humify · Employee management, made human.</span>
        </section>
        <section class="flex-4 bg-white flex justify-center items-center">
            <form class="flex flex-col gap-6 w-100">
                <div class="flex flex-col gap-2.25">
                    <h2 class="text-3xl text-slate-900 font-semibold">Welcome Back</h2>
                    <span class="text-slate-500">Sign in with your company-provided account.</span>
                </div>
                <div class="flex flex-col gap-1.5">
                    <label for="username" class="text-slate-700 text-sm font-semibold">Email</label>
                    <input placeholder="Enter your username" type="text" id="username" name="username"
                        class="rounded-md border border-slate-200 focus:ring-2 focus:ring-blue-300/50 p-2.75 focus:border-blue-400 focus:outline-none">
                </div>
                <div class="flex flex-col gap-1.5">
                    <label for="password" class="text-slate-700 text-sm font-semibold">Password</label>
                    <div class="relative w-full">
                        <input placeholder="Enter your password" type="password" id="password" name="password"
                            class="w-full rounded-md border border-slate-200 focus:ring-2 focus:ring-blue-300/50 p-2.75 focus:border-blue-400 focus:outline-none">
                        <x-bi-eye class="absolute right-3 top-3 w-5 h-5 text-slate-400" />
                    </div>
                </div>
                <button type="submit" class="bg-[#0F766E] py-3 text-white rounded-md">Sign In</button>
                <span class="text-slate-500 text-xs">Need access or help signing in? Contact your HR
                    administrator.</span>
                <hr class="h-px w-full bg-slate-200 border-0">
            </form>

        </section>

    </main>
</body>

</html>