<?php

session_start();
include "dbl.php";

if(!isset($_SESSION['student_pin'])){
    header("Location: loginpage.html");
    exit();
}

$pin = $_SESSION['student_pin'];

$stmt = $conn->prepare("SELECT * FROM profile WHERE pin_no=?");
$stmt->bind_param("s", $pin);
$stmt->execute();
$result = $stmt->get_result();
$data   = $result->fetch_assoc();


function getInitials($name){
    $parts = explode(' ', trim($name));
    $ini   = '';
    foreach($parts as $p) $ini .= strtoupper($p[0] ?? '');
    return substr($ini, 0, 2);
}
$initials = getInitials($data['name'] ?? 'U');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Profile</title>
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
<style>

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --navy:      #1a2744;
  --navy-mid:  #243460;
  --navy-lt:   #2e4080;
  --blue:      #4a9eff;
  --blue-bg:   #e8f3ff;
  --text:      #1a2744;
  --muted:     #6b7a99;
  --hint:      #a0aec0;
  --border:    #e2e8f0;
  --bg:        #f0f4f8;
  --card:      #ffffff;
  --green:     #16a34a;
  --green-dk:  #14532d;
  --radius:    14px;
  --shadow:    0 2px 12px rgba(0,0,0,.07);
}

body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg); min-height: 100vh; }
a    { text-decoration: none; color: inherit; }

.app    { display: flex; min-height: 100vh; }

.sidebar {
  width: 90px;
  background: var(--navy);
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 24px 0;
  gap: 4px;
  position: sticky;
  top: 0;
  height: 100vh;
  flex-shrink: 0;
}
.sidebar-logo { color: var(--blue); font-size: 30px; margin-bottom: 22px; }
.nav-item {
  display: flex; flex-direction: column; align-items: center; gap: 4px;
  padding: 10px 6px; width: 78px; border-radius: 10px;
  color: #8fa3c0; font-size: 10.5px; font-weight: 500; cursor: pointer;
  transition: .2s;
}
.nav-item i   { font-size: 20px; }
.nav-item:hover { background: rgba(255,255,255,.07); color: #fff; }
.nav-item.active { background: var(--navy-lt); color: #fff; }

/* ── Main ── */
.main { flex: 1; padding: 36px 40px; max-width: 860px; }

/* ── Page Header ── */
.page-header {
  display: flex; align-items: center; justify-content: space-between;
  margin-bottom: 28px;
}
.page-title { font-size: 22px; font-weight: 700; color: var(--text); }

.edit-btn {
  display: inline-flex; align-items: center; gap: 8px;
  padding: 9px 22px;
  border: 1.5px solid var(--blue); border-radius: 9px;
  background: #fff; color: var(--blue);
  font-size: 14px; font-weight: 600; font-family: inherit;
  cursor: pointer; transition: .2s;
}
.edit-btn:hover { background: var(--blue); color: #fff; }

/* ── Hero Card ── */
.hero-card {
  background: var(--card); border-radius: var(--radius);
  border: .5px solid var(--border); box-shadow: var(--shadow);
  padding: 28px; display: flex; align-items: center; gap: 24px;
  margin-bottom: 22px;
}
.avatar-wrap  { position: relative; flex-shrink: 0; }
.avatar-img   {
  width: 96px; height: 96px; border-radius: 50%;
  object-fit: cover; border: 3px solid var(--blue-bg);
}
.avatar-init  {
  width: 96px; height: 96px; border-radius: 50%;
  background: linear-gradient(135deg,#4a9eff,#1a5fc8);
  display: flex; align-items: center; justify-content: center;
  font-size: 28px; font-weight: 700; color: #fff;
  border: 3px solid var(--blue-bg);
}
.hero-info h2       { font-size: 22px; font-weight: 700; color: var(--text); }
.hero-info .role    { color: var(--blue); font-size: 14px; font-weight: 600; margin: 4px 0 2px; }
.hero-info .pin     { color: var(--muted); font-size: 13px; }

/* ── Section Card ── */
.section-card {
  background: var(--card); border-radius: var(--radius);
  border: .5px solid var(--border); box-shadow: var(--shadow);
  padding: 24px; margin-bottom: 22px;
}
.section-title {
  font-size: 15px; font-weight: 700; color: var(--text);
  padding-bottom: 12px; margin-bottom: 16px;
  border-bottom: .5px solid var(--border);
}
.info-row {
  display: flex; align-items: flex-start; padding: 11px 0;
  border-bottom: .5px solid #f5f7fb;
}
.info-row:last-child { border-bottom: none; }
.info-icon  { width: 34px; flex-shrink: 0; color: #b0bfd4; font-size: 17px; padding-top: 1px; }
.info-label { width: 170px; flex-shrink: 0; color: var(--muted); font-size: 13.5px; font-weight: 500; }
.info-value { color: var(--text); font-size: 13.5px; font-weight: 500; }

/* ── Overlay / Modal ── */
.overlay {
  display: none; position: fixed; inset: 0;
  background: rgba(10,20,50,.55); z-index: 200;
  align-items: center; justify-content: center; padding: 16px;
}
.overlay.open { display: flex; animation: fadeIn .2s ease; }
@keyframes fadeIn { from{opacity:0} to{opacity:1} }

.modal {
  background: #fff; border-radius: 20px;
  width: 540px; max-width: 100%; max-height: 90vh; overflow-y: auto;
  padding: 32px; box-shadow: 0 8px 40px rgba(0,0,0,.15);
  animation: slideUp .25s ease;
}
@keyframes slideUp { from{transform:translateY(20px);opacity:0} to{transform:translateY(0);opacity:1} }

.modal-header {
  display: flex; align-items: center; justify-content: space-between;
  margin-bottom: 24px;
}
.modal-header h2 {
  font-size: 17px; font-weight: 700; color: var(--text);
  display: flex; align-items: center; gap: 8px;
}
.modal-header h2 i { color: var(--blue); font-size: 20px; }
.modal-close {
  background: none; border: none; color: var(--muted);
  font-size: 20px; cursor: pointer; padding: 4px 6px;
  border-radius: 7px; transition: .2s; font-family: inherit;
}
.modal-close:hover { background: var(--bg); color: var(--text); }


.avatar-upload-row {
  display: flex; align-items: center; gap: 18px;
  margin-bottom: 22px; padding-bottom: 20px;
  border-bottom: .5px solid var(--border);
}
.modal-avatar {
  width: 72px; height: 72px; border-radius: 50%;
  object-fit: cover; border: 3px solid var(--blue-bg);
  flex-shrink: 0;
}
.modal-avatar-init {
  width: 72px; height: 72px; border-radius: 50%;
  background: linear-gradient(135deg,#4a9eff,#1a5fc8);
  display: flex; align-items: center; justify-content: center;
  font-size: 22px; font-weight: 700; color: #fff;
  border: 3px solid var(--blue-bg); flex-shrink: 0;
}
.upload-label {
  display: inline-flex; align-items: center; gap: 7px;
  padding: 9px 18px; border: 1.5px solid var(--border);
  border-radius: 9px; font-size: 13px; font-weight: 600;
  color: var(--muted); cursor: pointer; transition: .2s;
}
.upload-label:hover { border-color: var(--blue); color: var(--blue); }


.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.form-group { display: flex; flex-direction: column; gap: 6px; }
.form-group.span2 { grid-column: 1/-1; }
.form-group label { font-size: 12.5px; font-weight: 600; color: var(--muted); }
.form-group input,
.form-group select,
.form-group textarea {
  padding: 9px 13px;
  border: 1.5px solid var(--border); border-radius: 9px;
  font-size: 14px; color: var(--text); font-family: inherit;
  background: #fff; outline: none; transition: border .2s;
}
.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus { border-color: var(--blue); }
.form-group textarea { resize: none; height: 80px; }
.form-group input[readonly] { background: #f7f9ff; color: var(--muted); cursor: not-allowed; }


.modal-actions {
  display: flex; gap: 12px; justify-content: flex-end;
  margin-top: 24px; padding-top: 20px;
  border-top: .5px solid var(--border);
}
.btn-cancel {
  padding: 10px 22px; border: 1.5px solid var(--border);
  border-radius: 9px; background: #fff; color: var(--muted);
  font-size: 14px; font-weight: 600; font-family: inherit; cursor: pointer;
  transition: .2s;
}
.btn-cancel:hover { background: var(--bg); }
.btn-save {
  padding: 10px 28px; border: none; border-radius: 9px;
  background: var(--navy); color: #fff;
  font-size: 14px; font-weight: 600; font-family: inherit; cursor: pointer;
  transition: .2s;
}
.btn-save:hover { background: var(--navy-lt); }


.form-msg {
  padding: 10px 14px; border-radius: 9px;
  font-size: 13px; margin-top: 14px; display: none;
}
.form-msg.error   { background: #fff0f0; border: 1px solid #f7c1c1; color: #a32d2d; display: block; }
.form-msg.success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #14532d; display: block; }


.toast {
  position: fixed; bottom: 28px; right: 28px;
  padding: 13px 22px; border-radius: 12px;
  font-size: 14px; font-weight: 600; z-index: 999;
  opacity: 0; transform: translateY(10px);
  transition: .3s ease; pointer-events: none;
}
.toast.success { background: #1a2744; color: #fff; }
.toast.error   { background: #a32d2d; color: #fff; }
.toast.show    { opacity: 1; transform: translateY(0); }


@media(max-width:640px){
  .main          { padding: 20px 16px; }
  .sidebar       { width: 70px; }
  .form-grid     { grid-template-columns: 1fr; }
  .form-group.span2 { grid-column: auto; }
  .hero-card     { flex-direction: column; text-align: center; }
  .info-label    { width: 130px; }
}
</style>
</head>
<body>

<div class="app">

  <aside class="sidebar">
    <div class="sidebar-logo"><i class="ti ti-school"></i></div>
    <a class="nav-item" href="dashboard.php"><i class='bx bxs-dashboard'></i>Dashboard</a>
    <a class="nav-item" href="admint.php"><i class='bx bx-shield-quarter'></i>admin</a>
    <a class="nav-item" href="login.html"><i class='bx bxs-graduation'></i>student</a>
    <a class="nav-item" href="teacher_index.php"><i class='bx bx-chalkboard'></i>Teacher</a>
    <a class="nav-item" href="index1.php"><i class='bx bx-calendar-star'></i>Attendance</a>
    <a class="nav-item" href="index.php"><i class='bx bx-wallet'></i>Fees</a>
    <a class="nav-item" href="login1.php"><i class='bx bx-bar-chart-square'></i> results</a>
    <a class="nav-item" href="profile.php"> <i class='bx bx-user-circle'></i>profile</a>
    <a class="nav-item" href="dashboard.php"></i><i class='bx bx-log-out'></i>logout</a>
  </aside>

  
  <main class="main">

    <div class="page-header">
      <h1 class="page-title">My Profile</h1>
      <button class="edit-btn" id="editBtn">
        <i class="ti ti-edit"></i> Edit Profile
      </button>
    </div>

    
    <div class="hero-card">
      <div class="avatar-wrap">
  <?php $hasPic = !empty($data['profile_pic']) && file_exists($data['profile_pic']); ?>
  <img class="avatar-img" id="heroAvatarImg"
       src="<?php echo $hasPic ? htmlspecialchars($data['profile_pic']) : ''; ?>"
       alt="Avatar"
       style="<?php echo $hasPic ? '' : 'display:none'; ?>"
       onerror="this.style.display='none';document.getElementById('heroAvatarInit').style.display='flex';">
  <div class="avatar-init" id="heroAvatarInit"
       style="<?php echo $hasPic ? 'display:none' : ''; ?>">
    <?php echo $initials; ?>
  </div>
</div>
      <div class="hero-info">
        <h2><?php echo htmlspecialchars($data['name'] ?? '—'); ?></h2>
        <div class="role"><?php echo htmlspecialchars($data['role'] ?? 'Student'); ?></div>
        <div class="pin">ID: <?php echo htmlspecialchars($data['pin_no'] ?? '—'); ?></div>
      </div>
    </div>

  
    <div class="section-card">
      <div class="section-title">Personal Information</div>

      <div class="info-row">
        <span class="info-icon"><i class="ti ti-user"></i></span>
        <span class="info-label">Full Name</span>
        <span class="info-value"><?php echo htmlspecialchars($data['name'] ?? '—'); ?></span>
      </div>

      <div class="info-row">
        <span class="info-icon"><i class="ti ti-id-badge"></i></span>
        <span class="info-label">PIN No</span>
        <span class="info-value"><?php echo htmlspecialchars($data['pin_no'] ?? '—'); ?></span>
      </div>

      <div class="info-row">
        <span class="info-icon"><i class="ti ti-phone"></i></span>
        <span class="info-label">Phone</span>
        <span class="info-value"><?php echo htmlspecialchars($data['phone'] ?? '—'); ?></span>
      </div>

      <div class="info-row">
        <span class="info-icon"><i class="ti ti-calendar"></i></span>
        <span class="info-label">Date of Birth</span>
        <span class="info-value"><?php echo !empty($data['dob']) ? date('M j, Y', strtotime($data['dob'])) : '—'; ?></span>
      </div>

      <div class="info-row">
        <span class="info-icon"><i class="ti ti-map-pin"></i></span>
        <span class="info-label">Address</span>
        <span class="info-value"><?php echo htmlspecialchars($data['address'] ?? '—'); ?></span>
      </div>

    </div>

    <div class="section-card">
      <div class="section-title">Academic Information</div>

      <div class="info-row">
        <span class="info-icon"><i class="ti ti-user-check"></i></span>
        <span class="info-label">Role</span>
        <span class="info-value"><?php echo htmlspecialchars($data['role'] ?? '—'); ?></span>
      </div>

      <div class="info-row">
        <span class="info-icon"><i class="ti ti-building"></i></span>
        <span class="info-label">Department</span>
        <span class="info-value"><?php echo htmlspecialchars($data['dept'] ?? '—'); ?></span>
      </div>

      <div class="info-row">
        <span class="info-icon"><i class="ti ti-calendar-stats"></i></span>
        <span class="info-label">Year of Joining</span>
        <span class="info-value"><?php echo htmlspecialchars($data['year_of_join'] ?? '—'); ?></span>
      </div>

    </div>

  </main>
</div>


<div class="overlay" id="overlay">
  <div class="modal" role="dialog" aria-modal="true">

    <div class="modal-header">
      <h2><i class="ti ti-edit"></i> Edit Profile</h2>
      <button class="modal-close" id="closeModal" type="button">
        <i class="ti ti-x"></i>
      </button>
    </div>

    
    <form action="upload.php" method="POST" enctype="multipart/form-data" id="profileForm">

      <div class="avatar-upload-row">
  <?php $hasPic = !empty($data['profile_pic']) && file_exists($data['profile_pic']); ?>
  <img class="modal-avatar" id="modalAvatarImg"
       src="<?php echo $hasPic ? htmlspecialchars($data['profile_pic']) : ''; ?>"
       alt="Avatar"
       style="<?php echo $hasPic ? '' : 'display:none'; ?>"
       onerror="this.style.display='none';document.getElementById('modalAvatarInit').style.display='flex';">
  <div class="modal-avatar-init" id="modalAvatarInit"
       style="<?php echo $hasPic ? 'display:none' : ''; ?>">
    <?php echo $initials; ?>
  </div>
        <div>
          <label class="upload-label" for="picInput">
            <i class="ti ti-camera" style="font-size:16px"></i>
            Change Photo
          </label>
          <input type="file" id="picInput" name="profile_pic"
                 accept="image/*" hidden onchange="previewPhoto(event)">
          <input type="hidden" name="old_pic"
                 value="<?php echo htmlspecialchars($data['profile_pic'] ?? ''); ?>">
          <p style="font-size:11.5px;color:#a0aec0;margin-top:6px">
            JPG, PNG or GIF · max 2 MB
          </p>
        </div>
      </div>

      
      <div class="form-grid">

        <div class="form-group span2">
          <label>Full Name</label>
          <input type="text" name="name"
                 value="<?php echo htmlspecialchars($data['name'] ?? ''); ?>"
                 placeholder="Enter full name" required>
        </div>

        <div class="form-group">
          <label>PIN No</label>
          <input type="text" name="pin_no"
                 value="<?php echo htmlspecialchars($pin); ?>" readonly>
        </div>

        <div class="form-group">
          <label>Role</label>
          <select name="role" required>
            <option value="">Select Role</option>
            <option value="Student"
              <?php if(($data['role'] ?? '') == 'Student') echo 'selected'; ?>>Student</option>
            <option value="Admin"
              <?php if(($data['role'] ?? '') == 'Admin') echo 'selected'; ?>>Admin</option>
          </select>
        </div>

        <div class="form-group">
          <label>Department</label>
          <select name="dept" required>
            <option value="">Select Department</option>
            <option value="CME"
              <?php if(($data['dept'] ?? '') == 'CME') echo 'selected'; ?>>CME</option>
            <option value="ECE"
              <?php if(($data['dept'] ?? '') == 'ECE') echo 'selected'; ?>>ECE</option>
          </select>
        </div>

        <div class="form-group">
          <label>Year of Joining</label>
          <input type="number" name="year_of_join"
                 value="<?php echo htmlspecialchars($data['year_of_join'] ?? ''); ?>"
                 placeholder="e.g. 2023" required>
        </div>

        <div class="form-group">
          <label>Date of Birth</label>
          <input type="date" name="dob"
                 value="<?php echo htmlspecialchars($data['dob'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
          <label>Phone</label>
          <input type="text" name="phone"
                 value="<?php echo htmlspecialchars($data['phone'] ?? ''); ?>"
                 placeholder="Phone number" required>
        </div>

        <div class="form-group span2">
          <label>Address</label>
          <textarea name="address"
                    placeholder="Enter full address"><?php echo htmlspecialchars($data['address'] ?? ''); ?></textarea>
        </div>

      </div><!-- /form-grid -->

      <div class="form-msg" id="formMsg"></div>

      <div class="modal-actions">
        <button type="button" class="btn-cancel" id="cancelBtn">Cancel</button>
        <button type="submit" class="btn-save">
          <i class="ti ti-device-floppy"></i> Save Profile
        </button>
      </div>

    </form>
  </div>
</div>


<div class="toast" id="toast"></div>

<script>
const overlay   = document.getElementById('overlay');
const editBtn   = document.getElementById('editBtn');
const closeBtn  = document.getElementById('closeModal');
const cancelBtn = document.getElementById('cancelBtn');

function openModal(){
  overlay.classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeModal(){
  overlay.classList.remove('open');
  document.body.style.overflow = '';
}

editBtn.addEventListener('click', openModal);
closeBtn.addEventListener('click', closeModal);
cancelBtn.addEventListener('click', closeModal);

overlay.addEventListener('click', e => {
  if(e.target === overlay) closeModal();
});

document.addEventListener('keydown', e => {
  if(e.key === 'Escape') closeModal();
});

function previewPhoto(event){
  const file = event.target.files[0];
  if(!file) return;

  if(file.size > 2 * 1024 * 1024){
    alert('File too large. Max 2 MB.');
    event.target.value = '';
    return;
  }

  const reader = new FileReader();
  reader.onload = function(e){
    const src = e.target.result;

  
    const modalImg  = document.getElementById('modalAvatarImg');
    const modalInit = document.getElementById('modalAvatarInit');
    modalImg.src = src;
    modalImg.style.display = 'block';
    if(modalInit) modalInit.style.display = 'none';

    
    const heroImg  = document.getElementById('heroAvatarImg');
    const heroInit = document.getElementById('heroAvatarInit');
    if(heroImg){
      heroImg.src = src;
      heroImg.style.display = 'block';
    }
    if(heroInit) heroInit.style.display = 'none';
  };
  reader.readAsDataURL(file);
}
function showToast(msg, type){
  const t = document.getElementById('toast');
  t.textContent = (type === 'success' ? '✓ ' : '✕ ') + msg;
  t.className   = `toast ${type} show`;
  clearTimeout(t._t);
  t._t = setTimeout(() => t.classList.remove('show'), 3000);
}

// Show toast on redirect from upload.php
const params = new URLSearchParams(window.location.search);
if(params.get('status') === 'success') showToast('Profile updated successfully', 'success');
if(params.get('status') === 'error')   showToast('Update failed. Please try again.', 'error');
</script>

</body>
</html>