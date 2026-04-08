<?php get_header(); ?>

<div class="quiz-page">
  <div class="quiz-header">
    <div class="tag">3-question quiz</div>
    <h1 class="quiz-headline">Find your <em>perfect brow</em></h1>
    <p class="quiz-sub">Answer three quick questions and we'll match you with the service that suits your skin, lifestyle, and goals.</p>
  </div>

  <div class="quiz-progress" id="quizProgress">
    <div class="progress-dot active" id="dot0"></div>
    <div class="progress-dot" id="dot1"></div>
    <div class="progress-dot" id="dot2"></div>
  </div>

  <!-- STEP 1 -->
  <div class="quiz-card quiz-step active" id="step0">
    <div class="quiz-q-num">Question 1 of 3</div>
    <h2 class="quiz-question">What's your <em>skin type?</em></h2>
    <div class="quiz-options">
      <div class="quiz-option" data-val="oily">
        <div class="quiz-radio"><div class="quiz-radio-dot"></div></div>
        <div class="quiz-option-icon qoi1"></div>
        <div><div class="option-label">Oily or combination</div><div class="option-sublabel">My skin tends to shine by midday</div></div>
      </div>
      <div class="quiz-option" data-val="dry">
        <div class="quiz-radio"><div class="quiz-radio-dot"></div></div>
        <div class="quiz-option-icon qoi2"></div>
        <div><div class="option-label">Dry or normal</div><div class="option-sublabel">My skin rarely gets oily</div></div>
      </div>
      <div class="quiz-option" data-val="sensitive">
        <div class="quiz-radio"><div class="quiz-radio-dot"></div></div>
        <div class="quiz-option-icon qoi3"></div>
        <div><div class="option-label">Sensitive</div><div class="option-sublabel">My skin reacts easily to products</div></div>
      </div>
    </div>
    <div class="quiz-nav">
      <button class="quiz-back" style="visibility:hidden;">Back</button>
      <button class="quiz-next" id="next0">Continue →</button>
    </div>
  </div>

  <!-- STEP 2 -->
  <div class="quiz-card quiz-step" id="step1">
    <div class="quiz-q-num">Question 2 of 3</div>
    <h2 class="quiz-question">How much <em>maintenance</em> do you want?</h2>
    <div class="quiz-options">
      <div class="quiz-option" data-val="none">
        <div class="quiz-radio"><div class="quiz-radio-dot"></div></div>
        <div class="quiz-option-icon qoi2"></div>
        <div><div class="option-label">Wake up and go</div><div class="option-sublabel">I want zero effort brows every day</div></div>
      </div>
      <div class="quiz-option" data-val="little">
        <div class="quiz-radio"><div class="quiz-radio-dot"></div></div>
        <div class="quiz-option-icon qoi1"></div>
        <div><div class="option-label">A little touch-up is fine</div><div class="option-sublabel">I can spend 2–5 minutes on brows</div></div>
      </div>
      <div class="quiz-option" data-val="flexible">
        <div class="quiz-radio"><div class="quiz-radio-dot"></div></div>
        <div class="quiz-option-icon qoi3"></div>
        <div><div class="option-label">Open to anything</div><div class="option-sublabel">I just want beautiful brows</div></div>
      </div>
    </div>
    <div class="quiz-nav">
      <button class="quiz-back" onclick="goTo(0)">← Back</button>
      <button class="quiz-next" id="next1">Continue →</button>
    </div>
  </div>

  <!-- STEP 3 -->
  <div class="quiz-card quiz-step" id="step2">
    <div class="quiz-q-num">Question 3 of 3</div>
    <h2 class="quiz-question">What look are you <em>going for?</em></h2>
    <div class="quiz-options">
      <div class="quiz-option" data-val="natural">
        <div class="quiz-radio"><div class="quiz-radio-dot"></div></div>
        <div class="quiz-option-icon qoi2"></div>
        <div><div class="option-label">Soft and natural</div><div class="option-sublabel">Enhanced, but looks like my own brows</div></div>
      </div>
      <div class="quiz-option" data-val="defined">
        <div class="quiz-radio"><div class="quiz-radio-dot"></div></div>
        <div class="quiz-option-icon qoi1"></div>
        <div><div class="option-label">Bold and defined</div><div class="option-sublabel">I want noticeable, striking brows</div></div>
      </div>
      <div class="quiz-option" data-val="both">
        <div class="quiz-radio"><div class="quiz-radio-dot"></div></div>
        <div class="quiz-option-icon qoi3"></div>
        <div><div class="option-label">Somewhere in between</div><div class="option-sublabel">Defined but still natural-looking</div></div>
      </div>
    </div>
    <div class="quiz-nav">
      <button class="quiz-back" onclick="goTo(1)">← Back</button>
      <button class="quiz-next" id="next2" onclick="showResult()">See My Result →</button>
    </div>
  </div>

  <!-- RESULT -->
  <div class="quiz-result" id="quizResult">
    <div class="result-card">
      <div class="result-img" id="resultImg"></div>
      <div class="result-body">
        <div class="result-match">Your perfect match</div>
        <h2 class="result-name" id="resultName"></h2>
        <p class="result-desc" id="resultDesc"></p>
        <div class="result-details" id="resultDetails"></div>
        <div class="result-btns">
          <a href="booking.html" class="btn-primary" id="resultBookBtn">Book This Service</a>
          <button class="quiz-retake" onclick="retakeQuiz()">Retake Quiz</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const answers = {};
  let currentStep = 0;

  const results = {
    henna: {
      name: '<em>Henna Brows</em>',
      desc: 'Based on your answers, Henna Brows are your ideal starting point. Natural plant-based pigment gives you beautiful color and definition for up to 2 weeks with zero downtime — perfect if you want a low-commitment, gorgeous result that suits sensitive skin.',
      duration: '60 min',
      longevity: 'Up to 2 weeks',
      price: 'From $75',
      gradient: 'linear-gradient(140deg,#E8D5C4,#C9A882)',
    },
    strokeblend: {
      name: 'StrokeBlend™ <em>Combo Brows</em>',
      desc: 'Your answers point to StrokeBlend™ — Gabrielle\'s signature semi-permanent technique that combines hair strokes with powder shading. The result is incredibly natural-looking brows with lasting dimension. Wake up with perfect brows every single day.',
      duration: '2–2.5 hrs',
      longevity: '12–18 months',
      price: 'From $350',
      gradient: 'linear-gradient(140deg,#D4B896,#896C54)',
    },
    softblend: {
      name: 'SoftBlend™ <em>Ombré Brows</em>',
      desc: 'Your lifestyle and look preferences are a perfect match for SoftBlend™ Ombré Brows. A soft powdered gradient that starts lighter at the head and deepens at the tail — bold, defined, and effortlessly beautiful with semi-permanent staying power.',
      duration: '2 hrs',
      longevity: '12–18 months',
      price: 'From $300',
      gradient: 'linear-gradient(140deg,#C9A882,#5C3D2E)',
    },
    waxing: {
      name: 'Brow Waxing <em>&amp; Shaping</em>',
      desc: 'For you, precision waxing and shaping is the perfect match. Gabrielle\'s expert eye for shape and symmetry will define your natural brow architecture — clean, polished, and ready for your own makeup routine.',
      duration: '30 min',
      longevity: '3–4 weeks',
      price: 'From $35',
      gradient: 'linear-gradient(140deg,#F2EAE0,#C9A882)',
    },
  };

  function getResult() {
    const { skin, maintenance, look } = answers;
    if (skin === 'sensitive' || maintenance === 'little') return 'henna';
    if (maintenance === 'none' && look === 'natural') return 'strokeblend';
    if (maintenance === 'none' && look === 'defined') return 'softblend';
    if (maintenance === 'none' && look === 'both') return 'strokeblend';
    if (look === 'natural') return 'strokeblend';
    if (look === 'defined') return 'softblend';
    return 'strokeblend';
  }

  function goTo(step) {
    document.getElementById(`step${currentStep}`).classList.remove('active');
    currentStep = step;
    document.getElementById(`step${step}`).classList.add('active');
    updateProgress(step);
    window.scrollTo({ top: 200, behavior: 'smooth' });
  }

  function updateProgress(step) {
    for (let i = 0; i < 3; i++) {
      const dot = document.getElementById(`dot${i}`);
      dot.className = 'progress-dot';
      if (i < step) dot.classList.add('done');
      else if (i === step) dot.classList.add('active');
    }
  }

  function showResult() {
    document.getElementById(`step2`).style.display = 'none';
    document.getElementById('quizProgress').style.display = 'none';
    const r = results[getResult()];
    document.getElementById('resultImg').style.background = r.gradient;
    document.getElementById('resultName').innerHTML = r.name;
    document.getElementById('resultDesc').textContent = r.desc;
    document.getElementById('resultDetails').innerHTML = `
      <div class="result-detail-item"><div class="detail-label">Duration</div><div class="detail-val">${r.duration}</div></div>
      <div class="result-detail-item"><div class="detail-label">Results last</div><div class="detail-val">${r.longevity}</div></div>
      <div class="result-detail-item"><div class="detail-label">Starting from</div><div class="detail-val">${r.price}</div></div>
    `;
    document.getElementById('quizResult').style.display = 'block';
    window.scrollTo({ top: 200, behavior: 'smooth' });
  }

  function retakeQuiz() {
    Object.keys(answers).forEach(k => delete answers[k]);
    document.querySelectorAll('.quiz-option').forEach(o => o.classList.remove('selected'));
    document.querySelectorAll('.quiz-next').forEach(b => b.classList.remove('enabled'));
    document.getElementById('quizResult').style.display = 'none';
    document.getElementById('step2').style.display = '';
    document.getElementById('quizProgress').style.display = '';
    goTo(0);
  }

  // Option selection
  document.querySelectorAll('.quiz-step').forEach((card, stepIdx) => {
    card.querySelectorAll('.quiz-option').forEach(opt => {
      opt.addEventListener('click', () => {
        card.querySelectorAll('.quiz-option').forEach(o => o.classList.remove('selected'));
        opt.classList.add('selected');
        const keyMap = ['skin','maintenance','look'];
        answers[keyMap[stepIdx]] = opt.dataset.val;
        document.getElementById(`next${stepIdx}`).classList.add('enabled');
      });
    });
  });

  // Next buttons
  for (let i = 0; i < 2; i++) {
    document.getElementById(`next${i}`).addEventListener('click', () => {
      if (document.getElementById(`next${i}`).classList.contains('enabled')) goTo(i + 1);
    });
  }
</script>

<?php get_footer(); ?>