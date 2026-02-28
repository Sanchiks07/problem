<x-layout>
    <div class="main-home-container">
        <!-- Welcome Section -->
        <section id="introduction" class="introduction-section">
            <div class="introduction-overlay">
                <h1>Welcome to BrainSpace</h1>
                <p>Your personal space for managing and organizing your thoughts and ideas.</p>
                <a href="#about" class="introduction-btn">Learn More</a>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="about-section">
            <h2>About BrainSpace</h2>
            <p>BrainSpace is your personal hub for ideas, tasks, and inspiration. Organize your thoughts, track your progress, and unlock your productivity with a clean, intuitive interface that keeps you focused on what matters most.</p>
            <div class="features">
                <div class="feature">
                    <h3>Organize</h3>
                    <p>Keep all your ideas and tasks neatly structured and accessible.</p>
                </div>
                <div class="feature">
                    <h3>Track</h3>
                    <p>Stay on top of your progress and see how your projects evolve over time.</p>
                </div>
                <div class="feature">
                    <h3>Inspire</h3>
                    <p>Discover ways to spark creativity and enhance your productivity.</p>
                </div>
            </div>
        </section>

        <!-- Register Section -->
        <section id="register" class="register-section">
            <h2>Ready to get started?</h2>
            <p>Create your BrainSpace account today and take control of your thoughts.</p>
            <a href="{{ route('register') }}" class="register-btn">Register</a>
        </section>

        <!-- Reviews Section -->
        <section id="reviews" class="reviews-section">
            <h2>What our users say</h2>
            <div class="reviews-container">
                <div class="review">
                    <p>"BrainSpace changed the way I organize my ideas. Can't imagine life without it!"</p>
                    <span>- Alex D.</span>
                </div>
                <div class="review">
                    <p>"Clean, intuitive, and inspiring. Finally a tool that keeps me focused."</p>
                    <span>- Jamie K.</span>
                </div>
                <div class="review">
                    <p>"I love how simple it is to track my tasks. BrainSpace keeps me motivated every day."</p>
                    <span>- Taylor S.</span>
                </div>
                <div class="review">
                    <p>"A perfect blend of organization and creativity. My go-to productivity tool!"</p>
                    <span>- Morgan L.</span>
                </div>
            </div>
        </section>
    </div>
</x-layout>