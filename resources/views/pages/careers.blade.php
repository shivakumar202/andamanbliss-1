@extends('layouts.app')
@section('title', 'Careers')
@section('keywords', 'Andaman Bliss™ careers, travel jobs in Andaman, Andaman job openings, travel agency jobs, tourism careers, job vacancies in Andaman, job vacancies in Port Blair')
@section('description', 'Passionate about travel? Explore exciting career opportunities at Andaman Bliss™. Join our team and be part of the leading travel agency in Andaman, Apply now.')

@section('content')
<!-- Header Section -->
<section class="careers-header">
    <div class="careers-overlay"></div>
    <div class="container">
        <div class="careers-header-content">
            <h1 class="text-white">Join <span class="text-gradient">Us</span></h1>
            <p class="careers-subtitle">Looking for an exciting work culture, look at the wide career oppurtunity at Andaman Bliss™</p>
            <div class="breadcrumb-wrapper">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Careers</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="careers-shape">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#ffffff" fill-opacity="1"
                d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,133.3C672,139,768,181,864,181.3C960,181,1056,139,1152,122.7C1248,107,1344,117,1392,122.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
            </path>
        </svg>
    </div>
</section>

<!-- Introduction Section -->
<section class="careers-intro-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="careers-intro-container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="careers-intro-content">
                                <span class="section-subtitle">Work With Us</span>
                                <h2 class="section-title">Are you looking for a job? <span class="text-gradient">Join Andaman Today</span></h2>
                                <p class="careers-desc" style="text-align:justify">
                                Join Andaman Bliss™, one of the premier travel agencies in Andaman that will help us create amazing experiences in Andaman and beyond. Be a part of a team who is dedicated to providing travelers with the ability to discover the amazing beauty of these islands and give them the absolute best service possible. We are always searching for passionate individuals to join us.
                                </p>
                                <a href="#available-jobs" class="careers-btn scroll-to-jobs">
                                    <span>See Available Jobs</span>
                                    <i class="fas fa-arrow-down"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="careers-intro-image">
                                <img src="{{ asset('site/img/career-right.png') }}" alt="Career at Andaman Bliss™"
                                    class="img-fluid">
                                <div class="image-shape"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Job Listings Section -->
<section class="job-listings-section" id="available-jobs">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="section-intro text-center mb-5">
                    <span class="section-subtitle">Position Opened</span>
                    <h2 class="section-title">We Are Curr<span class="text-gradient">ently Hiring</span></h2>
                    <p class="lead">Look at our requirements 
                        Explore our current job openings and find the perfect role for your skills and
                        passion</p>
                </div>

                <div class="job-listings-container">
                    <!-- Job Card 1 -->
                    <div class="job-card">
                        <div class="job-card-header">
                            <div class="job-icon">
                                <i class="fas fa-laptop-code"></i>
                            </div>
                            <div class="job-title-container">
                                <h3 class="job-title">Web Developer</h3>
                                <div class="job-meta">
                                    <span class="job-location"><i class="fas fa-map-marker-alt"></i> Andaman Nicobar
                                        Islands</span>
                                    <span class="job-type"><i class="fas fa-briefcase"></i> Full Time</span>
                                    <span class="job-positions"><i class="fas fa-users"></i> 2 Positions</span>
                                </div>
                            </div>
                        </div>
                        <div class="job-card-body">
                            <div class="job-requirements">
                                <div class="requirement-item">
                                    <h4><i class="fas fa-code"></i> Coding Skills</h4>
                                    <p>PHP, Laravel, MySQL, Node.js, CodeIgniter</p>
                                </div>
                                <div class="requirement-item">
                                    <h4><i class="fas fa-tools"></i> Software Skills</h4>
                                    <p>VS Code, Sublime Text, etc.</p>
                                </div>
                                <div class="requirement-item">
                                    <h4><i class="fas fa-user-graduate"></i> Qualification</h4>
                                    <p>Any Graduate / Any Post Graduate</p>
                                </div>
                                <div class="requirement-item">
                                    <h4><i class="fas fa-history"></i> Experience</h4>
                                    <p>Minimum 1 Year</p>
                                </div>
                                <div class="requirement-item">
                                    <h4><i class="fas fa-money-bill-wave"></i> Salary</h4>
                                    <p>As Per Industry Standards</p>
                                </div>
                            </div>
                            <div class="job-description">
                                <h4>Job Description</h4>
                                <p>We are looking for a Web Developer, preferably 1 year of work-related experience in web development. The person we are looking for should have a solid understanding of web technologies and be able to create responsive, high-performance sites.</p>
                            </div>
                            <div class="job-apply">
                                <button class="apply-btn" onclick="scrollToForm()">
                                    <i class="fas fa-paper-plane"></i> Apply Now
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Job Card 2 -->
                    <div class="job-card">
                        <div class="job-card-header">
                            <div class="job-icon">
                                <i class="fas fa-database"></i>
                            </div>
                            <div class="job-title-container">
                                <h3 class="job-title">Data Entry Operator</h3>
                                <div class="job-meta">
                                    <span class="job-location"><i class="fas fa-map-marker-alt"></i> Andaman Nicobar
                                        Islands</span>
                                    <span class="job-type"><i class="fas fa-briefcase"></i> Full Time</span>
                                    <span class="job-positions"><i class="fas fa-users"></i> 2 Positions</span>
                                </div>
                            </div>
                        </div>
                        <div class="job-card-body">
                            <div class="job-requirements">
                                <div class="requirement-item">
                                    <h4><i class="fas fa-laptop"></i> Skills</h4>
                                    <p>Good knowledge of computers and Internet</p>
                                </div>
                                <div class="requirement-item">
                                    <h4><i class="fas fa-tools"></i> Software Skills</h4>
                                    <p>Microsoft Excel, Word, PowerPoint, Database Handling</p>
                                </div>
                                <div class="requirement-item">
                                    <h4><i class="fas fa-user-graduate"></i> Qualification</h4>
                                    <p>Minimum 12th Pass</p>
                                </div>
                                <div class="requirement-item">
                                    <h4><i class="fas fa-history"></i> Experience</h4>
                                    <p>Fresher or 6 Month Experience in Travel Industry</p>
                                </div>
                                <div class="requirement-item">
                                    <h4><i class="fas fa-money-bill-wave"></i> Salary</h4>
                                    <p>As Per Industry Standards</p>
                                </div>
                            </div>
                            <div class="job-description">
                                <h4>Job Description</h4>
                                <p>We are seeking an detail-oriented Travel Data Entry Operator with 6 months of experience at a minimum. The successful candidate will work with travel data entry, book travel and travel records which will be maintained and upgraded accordingly.</p>
                            </div>
                            <div class="job-apply">
                                <button class="apply-btn" onclick="scrollToForm()">
                                    <i class="fas fa-paper-plane"></i> Apply Now
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Job Card 3 -->
                    <div class="job-card">
                        <div class="job-card-header">
                            <div class="job-icon">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <div class="job-title-container">
                                <h3 class="job-title">Sales Executive</h3>
                                <div class="job-meta">
                                    <span class="job-location"><i class="fas fa-map-marker-alt"></i> Andaman Nicobar
                                        Islands</span>
                                    <span class="job-type"><i class="fas fa-briefcase"></i> Full Time</span>
                                    <span class="job-positions"><i class="fas fa-users"></i> 5 Positions</span>
                                </div>
                            </div>
                        </div>
                        <div class="job-card-body">
                            <div class="job-requirements">
                                <div class="requirement-item">
                                    <h4><i class="fas fa-comments"></i> Skills</h4>
                                    <p>Excellent verbal and written communication skills, Strong customer relationship
                                        and follow-up skills</p>
                                </div>
                                <div class="requirement-item">
                                    <h4><i class="fas fa-tools"></i> Software Skills</h4>
                                    <p>Microsoft Excel, Word, PowerPoint</p>
                                </div>
                                <div class="requirement-item">
                                    <h4><i class="fas fa-user-graduate"></i> Qualification</h4>
                                    <p>Higher Secondary (12th Pass) (Preferred)</p>
                                </div>
                                <div class="requirement-item">
                                    <h4><i class="fas fa-history"></i> Experience</h4>
                                    <p>Fresher or 6 Month Experience</p>
                                </div>
                                <div class="requirement-item">
                                    <h4><i class="fas fa-money-bill-wave"></i> Salary</h4>
                                    <p>As Per Industry Standards</p>
                                </div>
                            </div>
                            <div class="job-description">
                                <h4>Job Description</h4>
                                <p>We are seeking an energetic and self-motivated Sales Executive with sales experience in travel. The successful candidate will maintain sales, develop strong client relationships, and sell travel services and packages.</p>
                            </div>
                            <div class="job-apply">
                                <button class="apply-btn" onclick="scrollToForm()">
                                    <i class="fas fa-paper-plane"></i> Apply Now
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
            <div>
                <h3 class="fw-bold pt-5 job-title">Job Title : Web Designers</h3>
                <ul>
                    <li><strong>Coding Skill :</strong> Html5, CSS3, Jquery</li>
                    <li><strong>Software Skill :</strong> Photoshop, Dreamweaver</li>
                    <li><strong>Location :</strong> Andaman Nicobar Islands</li>
                    <li><strong>Experience: </strong> Fresher or 6 Month Experience</li>
                    <li><strong>Salary :</strong> As Per Industry</li>
                    <li><strong>Qualification:</strong> Any Graduate / Any Post Graduate</li>
                </ul>
                <p class="job-descript">
                    <strong> Job Description :</strong> We are looking for an Fresher or experienced Web Designer with
                    good knowledge of Photoshop, Dreamweaver . Create website layouts with latest Photoshop standards.
                    Make Responsive Websites using Bootstrap
                </p>
                <div class="d-flex justify-content-end">
                    <button class="btn btn_theme btn_md text-white ferry-inquiry-btn bike-inquiry-btn text-center" onclick="scrollToForm()">Apply
                        Now</button>
                </div>
            </div>
        </div>
        <hr>-->
                    <!-- Application Section -->
                    <div class="application-section" id="apply-form">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="join-team-content" style="text-align:justify">
                                    <span class="section-subtitle">Career Growth</span>
                                    <h2 class="section-title">Join Our Dynamic Team, <span class="text-gradient">Grow
                                            With Us!</span></h2>
                                    <p class="join-team-desc">
                                    Are you ready to take the first step into a professional career with exciting opportunities to learn and develop? Andamanbliss Tour and Travel is that opportunity! We are a stylish, dynamic company located in the exciting context of the Andaman and Nicobar Islands and we are focused on providing a challenging, yet supportive environment which promotes professional development.
                                    </p>
                                    <p class="join-team-desc">
                                    Our mission is focused on creating unforgettable travel experiences while we add amazing destinations to our amazing company, opportunities to work at Andamanbliss presents amazing opportunities. Whether you are a very qualified professional or this is your first step in your career, Andamanbliss Tour and Travel is here to assist you in developing new skills, expanding your knowledge, and embark on continuous professional development.
                                    </p>
                                    <div class="team-benefits">
                                        <div class="benefit-item">
                                            <div class="benefit-icon">
                                                <i class="fas fa-chart-line"></i>
                                            </div>
                                            <div class="benefit-content">
                                                <h4>Career Advancement</h4>
                                                <p>Opportunities to advance and develop skills</p>
                                            </div>
                                        </div>
                                        <div class="benefit-item">
                                            <div class="benefit-icon">
                                                <i class="fas fa-users"></i>
                                            </div>
                                            <div class="benefit-content">
                                                <h4>Supportive Team</h4>
                                                <p>You will be working with passionate professionals in an open and supportive environment</p>
                                            </div>
                                        </div>
                                        <div class="benefit-item">
                                            <div class="benefit-icon">
                                                <i class="fas fa-map-marked-alt"></i>
                                            </div>
                                            <div class="benefit-content">
                                                <h4>Beautiful Setting</h4>
                                                <p>Located in paradise (the Andaman and Nicobar Islands)</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="application-form-container">
                                    <div class="application-form-header">
                                        <div class="form-icon">
                                            <i class="fas fa-file-alt"></i>
                                        </div>
                                        <h3>Job Application</h3>
                                        <p>Fill out the form below to apply for a position at Andaman Bliss™</p>
                                    </div>
                                    <form action="#" id="applyForm" class="application-form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="first">First Name</label>
                                                    <input type="text" name="first" id="first" class="form-control"
                                                        placeholder="Enter first name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="last">Last Name</label>
                                                    <input type="text" name="last" id="last" class="form-control"
                                                        placeholder="Enter last name" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Email Address</label>
                                                    <input type="email" name="email" id="email" class="form-control"
                                                        placeholder="Enter email address" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone">Phone Number</label>
                                                    <input type="tel" name="phone" id="phone" class="form-control"
                                                        placeholder="Enter phone number" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="job_role">Position Applied For</label>
                                                    <select name="job_role" id="job_role" class="form-control" required>
                                                        <option value="">Select Position</option>
                                                        <option value="web_developer">Web Developer</option>
                                                        <option value="data_entry">Data Entry Operator</option>
                                                        <option value="sales">Sales Executive</option>
                                                        <option value="manager">Tour Manager</option>
                                                        <option value="coordinator">Tour Coordinator</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="date">Application Date</label>
                                                    <input type="date" name="date" id="date" class="form-control"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="experience">Experience</label>
                                                    <textarea name="experience" id="experience" class="form-control"
                                                        rows="3"
                                                        placeholder="Briefly describe your relevant experience"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group file-upload">
                                                    <label for="cv">Upload Resume/CV</label>
                                                    <div class="file-upload-wrapper">
                                                        <input type="file" name="cv" id="cv" class="form-control-file"
                                                            required>
                                                        <span class="file-info">PDF, DOC or DOCX (Max 2MB)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-submit">
                                            <button type="submit" class="submit-btn">
                                                <i class="fas fa-paper-plane"></i> Submit Application
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</section>

@endsection

@push('styles')
<style type="text/css">
:root {
    --primary-color: rgb(17, 157, 213);
    --primary-light: rgba(17, 157, 213, 0.1);
    --secondary-color: #fd6e0f;
    --secondary-light: rgba(253, 110, 15, 0.1);
    --text-dark: #333;
    --text-light: #666;
    --white: #fff;
    --light-bg: #f8f9fa;
    --border-radius: 12px;
    --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    --transition: all 0.3s ease;
}

/* Header Section Styles */
.careers-header {
    position: relative;
    background-image: url('https://images.unsplash.com/photo-1517048676732-d65bc937f952?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
    background-size: cover;
    background-position: center;
    min-height: 300px;
    display: flex;
    align-items: center;
    color: var(--white);
    padding: 80px 0 100px;
    overflow: hidden;
}

.careers-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(17, 157, 213, 0.85) 0%, rgba(17, 157, 213, 0.7) 100%);
    z-index: 1;
}

.careers-header .container {
    z-index: 2;
    position: relative;
}

.careers-header-content {
    padding: 2rem 0;
    text-align: center;
}

.careers-header-content h1 {
    font-size: 2.8rem;
    font-weight: 800;
    margin-bottom: 1rem;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

.careers-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    margin-bottom: 1.5rem;
}

.breadcrumb-wrapper {
    display: inline-block;
    background-color: rgba(255, 255, 255, 0.2);
    padding: 0.5rem 1.5rem;
    border-radius: 50px;
}

.breadcrumb {
    margin-bottom: 0;
}

.breadcrumb-item a {
    color: var(--white);
    text-decoration: none;
    font-weight: 500;
}

.breadcrumb-item.active {
    color: rgba(255, 255, 255, 0.8);
}

.breadcrumb-item+.breadcrumb-item::before {
    color: rgba(255, 255, 255, 0.6);
}

.careers-shape {
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    z-index: 2;
    line-height: 0;
}

.careers-shape svg {
    width: 100%;
    height: 80px;
}

/* Introduction Section */
.careers-intro-section {
    padding: 60px 0;
    background-color: var(--white);
}

.careers-intro-container {
    padding: 2rem;
    background-color: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
}

.section-intro {
    text-align: center;
    margin-bottom: 2rem;
}

.section-subtitle {
    display: inline-block;
    background-color: var(--primary-light);
    color: var(--primary-color);
    padding: 0.4rem 1rem;
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.section-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1rem;
}

.section-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: rgb(17, 157, 213);
    margin-bottom: 1rem;
}

.text-gradient {
    color: #fd6e0f;
    font-weight: 800;
    display: inline-block;
}

.careers-desc {
    font-size: 1rem;
    line-height: 1.7;
    color: var(--text-light);
    margin-bottom: 1.5rem;
}

.careers-btn {
    display: inline-flex;
    align-items: center;
    padding: 0.8rem 1.5rem;
    background-color: var(--primary-color);
    color: var(--white);
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    transition: var(--transition);
}

.careers-btn:hover {
    background-color: var(--secondary-color);
    transform: translateY(-3px);
    color: var(--white);
}

.careers-btn i {
    margin-left: 0.5rem;
    transition: var(--transition);
}

.careers-btn:hover i {
    transform: translateY(3px);
}

.careers-intro-image {
    position: relative;
    padding: 1rem;
}

.careers-intro-image img {
    border-radius: var(--border-radius);
    position: relative;
    z-index: 2;
}

.image-shape {
    position: absolute;
    top: 0;
    right: 0;
    width: 80%;
    height: 80%;
    background-color: var(--primary-light);
    border-radius: var(--border-radius);
    z-index: 1;
}

/* Job Listings Section */
.job-listings-section {
    padding: 60px 0;
    background-color: var(--light-bg);
}

.job-listings-container {
    margin-top: 2rem;
}

.job-card {
    background-color: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    margin-bottom: 2rem;
    overflow: hidden;
    transition: var(--transition);
}

.job-card:hover {
    transform: translateY(-5px);
}

.job-card-header {
    display: flex;
    align-items: center;
    padding: 1.5rem;
    background: linear-gradient(135deg, var(--primary-color) 0%, #0e8bc0 100%);
    color: var(--white);
}

.job-icon {
    width: 60px;
    height: 60px;
    background-color: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1.5rem;
    flex-shrink: 0;
}

.job-icon i {
    font-size: 1.8rem;
}

.job-title-container {
    flex-grow: 1;
}

.job-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.job-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
}

.job-meta span {
    display: inline-flex;
    align-items: center;
    font-size: 0.9rem;
    opacity: 0.9;
}

.job-meta span i {
    margin-right: 0.3rem;
}

.job-card-body {
    padding: 1.5rem;
}

.job-requirements {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.requirement-item h4 {
    display: flex;
    align-items: center;
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
}

.requirement-item h4 i {
    color: var(--primary-color);
    margin-right: 0.5rem;
}

.requirement-item p {
    font-size: 0.9rem;
    color: var(--text-light);
    margin-bottom: 0;
}

.job-description {
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid #eee;
}

.job-description h4 {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.75rem;
}

.job-description p {
    font-size: 0.95rem;
    line-height: 1.7;
    color: var(--text-light);
    margin-bottom: 0;
}

.job-apply {
    margin-top: 1.5rem;
    text-align: right;
}

.apply-btn {
    display: inline-flex;
    align-items: center;
    padding: 0.8rem 1.5rem;
    background-color: var(--secondary-color);
    color: var(--white);
    border: none;
    border-radius: 50px;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
}

.apply-btn:hover {
    background-color: #e05d00;
    transform: translateY(-3px);
}

.apply-btn i {
    margin-right: 0.5rem;
}

/* Application Section */
.application-section {
    margin-top: 3rem;
    padding: 3rem;
    background-color: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
}

.join-team-content {
    padding-right: 2rem;
}

.join-team-desc {
    font-size: 0.95rem;
    line-height: 1.7;
    color: var(--text-light);
    margin-bottom: 1.5rem;
}

.team-benefits {
    margin-top: 2rem;
}

.benefit-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 1.5rem;
}

.benefit-icon {
    width: 40px;
    height: 40px;
    background-color: var(--primary-light);
    color: var(--primary-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    flex-shrink: 0;
}

.benefit-content h4 {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.3rem;
}

.benefit-content p {
    font-size: 0.9rem;
    color: var(--text-light);
    margin-bottom: 0;
}

.application-form-container {
    background-color: var(--white);
    border-radius: var(--border-radius);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    overflow: hidden;
}

.application-form-header {
    padding: 1.5rem;
    background: linear-gradient(135deg, var(--primary-color) 0%, #0e8bc0 100%);
    color: var(--white);
    text-align: center;
}

.form-icon {
    width: 60px;
    height: 60px;
    background-color: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
}

.form-icon i {
    font-size: 1.8rem;
}

.application-form-header h3 {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.application-form-header p {
    font-size: 0.95rem;
    opacity: 0.9;
    margin-bottom: 0;
}

.application-form {
    padding: 2rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
}

.form-control {
    width: 100%;
    padding: 0.8rem 1rem;
    border: 1px solid #ddd;
    border-radius: var(--border-radius);
    font-size: 0.95rem;
    color: var(--text-dark);
    transition: var(--transition);
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(17, 157, 213, 0.25);
    outline: none;
}

.file-upload {
    position: relative;
}

.file-upload-wrapper {
    position: relative;
    padding: 1rem;
    border: 2px dashed #ddd;
    border-radius: var(--border-radius);
    text-align: center;
    transition: var(--transition);
}

.file-upload-wrapper:hover {
    border-color: var(--primary-color);
}

.form-control-file {
    position: relative;
    z-index: 2;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
}

.file-info {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 0.9rem;
    color: var(--text-light);
    pointer-events: none;
}

.form-submit {
    margin-top: 2rem;
    text-align: center;
}

.submit-btn {
    display: inline-flex;
    align-items: center;
    padding: 0.8rem 2rem;
    background-color: var(--primary-color);
    color: var(--white);
    border: none;
    border-radius: 50px;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
}

.submit-btn:hover {
    background-color: var(--secondary-color);
    transform: translateY(-3px);
}

.submit-btn i {
    margin-right: 0.5rem;
}

/* Responsive Styles */
@media (max-width: 992px) {
    .careers-header-content h1 {
        font-size: 2.2rem;
    }

    .careers-subtitle {
        font-size: 1rem;
    }

    .section-title {
        font-size: 1.5rem;
    }

    .careers-intro-container {
        padding: 1.5rem;
    }

    .careers-intro-image {
        margin-top: 2rem;
    }

    .job-requirements {
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    }

    .join-team-content {
        padding-right: 0;
        margin-bottom: 2rem;
    }

    .application-section {
        padding: 2rem;
    }
}

@media (max-width: 768px) {
    .careers-header {
        min-height: 250px;
        padding: 60px 0 80px;
    }

    .careers-header-content h1 {
        font-size: 1.8rem;
    }

    .job-card-header {
        flex-direction: column;
        text-align: center;
    }

    .job-icon {
        margin-right: 0;
        margin-bottom: 1rem;
    }

    .job-meta {
        justify-content: center;
    }

    .job-requirements {
        grid-template-columns: 1fr;
    }

    .job-apply {
        text-align: center;
    }

    .benefit-item {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .benefit-icon {
        margin-right: 0;
        margin-bottom: 0.5rem;
    }
}

@media (max-width: 576px) {
    .careers-header {
        min-height: 200px;
        padding: 50px 0 70px;
    }

    .careers-header-content h1 {
        font-size: 1.5rem;
    }

    .breadcrumb-wrapper {
        padding: 0.4rem 1rem;
    }

    .application-section {
        padding: 1.5rem;
    }

    .application-form {
        padding: 1.5rem;
    }
}
</style>
@endpush

@push('scripts')
<script type="text/javascript">
$(document).ready(function() {
    // Smooth scroll to application form
    function scrollToForm() {
        $('html, body').animate({
            scrollTop: $("#apply-form").offset().top - 100
        }, 800);
    }

    // Make the scrollToForm function available globally
    window.scrollToForm = scrollToForm;

    // Smooth scroll for the "See Available Jobs" button
    $('.scroll-to-jobs').on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: $('#available-jobs').offset().top - 100
        }, 800);
    });

    // File upload handling
    $('#cv').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        if (fileName) {
            $('.file-info').text(fileName);
        } else {
            $('.file-info').text('PDF, DOC or DOCX (Max 2MB)');
        }
    });

    // Form validation
    $('#applyForm').on('submit', function(e) {
        e.preventDefault();

        // Basic validation
        var isValid = true;
        $(this).find('[required]').each(function() {
            if (!$(this).val()) {
                isValid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        if (isValid) {
            // Here you would normally submit the form via AJAX
            // For demo purposes, just show an alert
            alert('Your application has been submitted successfully!');
            $(this)[0].reset();
            $('.file-info').text('PDF, DOC or DOCX (Max 2MB)');
        } else {
            alert('Please fill in all required fields.');
        }
    });
});
</script>
@endpush