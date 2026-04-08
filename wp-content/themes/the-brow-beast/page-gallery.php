<?php get_header(); ?>

<section class="section section--white">
  <div class="sec-header">
    <div>
      <div class="tag" style="margin-bottom:8px;">Real results</div>
      <h1 class="sec-title">Before <em>&amp; After</em> Gallery</h1>
    </div>
  </div>

  <div class="filter-bar">
    <button class="filter-btn active" data-filter="all">All</button>
    <button class="filter-btn" data-filter="strokeblend">StrokeBlend™</button>
    <button class="filter-btn" data-filter="softblend">SoftBlend™</button>
    <button class="filter-btn" data-filter="henna">Henna Brows</button>
    <button class="filter-btn" data-filter="waxing">Brow Waxing</button>
    <button class="filter-btn" data-filter="corrections">Corrections</button>
  </div>

  <div class="masonry-grid" id="gallery">
    <div class="masonry-item" data-cat="strokeblend">
      <div class="ph ph-tall c1 img-fill"></div>
      <div class="item-overlay"><div class="item-tag">StrokeBlend™ Combo</div></div>
    </div>
    <div class="masonry-item" data-cat="henna">
      <div class="ph ph-mid c2 img-fill"></div>
      <div class="item-overlay"><div class="item-tag">Henna Brows</div></div>
    </div>
    <div class="masonry-item" data-cat="softblend">
      <div class="ph ph-short c3 img-fill"></div>
      <div class="item-overlay"><div class="item-tag">SoftBlend™ Ombré</div></div>
    </div>
    <div class="masonry-item" data-cat="waxing">
      <div class="ph ph-mid c4 img-fill"></div>
      <div class="item-overlay"><div class="item-tag">Brow Waxing</div></div>
    </div>
    <div class="masonry-item" data-cat="strokeblend">
      <div class="ph ph-short c5 img-fill"></div>
      <div class="item-overlay"><div class="item-tag">StrokeBlend™ Combo</div></div>
    </div>
    <div class="masonry-item" data-cat="henna">
      <div class="ph ph-mid c6 img-fill"></div>
      <div class="item-overlay"><div class="item-tag">Henna Brows</div></div>
    </div>
    <div class="masonry-item" data-cat="softblend">
      <div class="ph ph-tall c7 img-fill"></div>
      <div class="item-overlay"><div class="item-tag">SoftBlend™ Ombré</div></div>
    </div>
    <div class="masonry-item" data-cat="corrections">
      <div class="ph ph-mid c8 img-fill"></div>
      <div class="item-overlay"><div class="item-tag">Corrections</div></div>
    </div>
    <div class="masonry-item" data-cat="waxing">
      <div class="ph ph-short c9 img-fill"></div>
      <div class="item-overlay"><div class="item-tag">Brow Waxing</div></div>
    </div>
    <div class="masonry-item" data-cat="strokeblend">
      <div class="ph ph-mid c1 img-fill"></div>
      <div class="item-overlay"><div class="item-tag">StrokeBlend™ Combo</div></div>
    </div>
    <div class="masonry-item" data-cat="henna">
      <div class="ph ph-short c3 img-fill"></div>
      <div class="item-overlay"><div class="item-tag">Henna Brows</div></div>
    </div>
    <div class="masonry-item" data-cat="softblend">
      <div class="ph ph-mid c5 img-fill"></div>
      <div class="item-overlay"><div class="item-tag">SoftBlend™ Ombré</div></div>
    </div>
  </div>
</section>

<!-- ═══ BEFORE / AFTER SLIDERS ══════════════════════════════════ -->
<section class="ba-section">
  <div class="tag" style="color:var(--warm-tan);margin-bottom:8px;">Interactive comparison</div>
  <h2 class="ba-title">Drag to <em>compare</em></h2>
  <p class="ba-sub">Slide to reveal the transformation — before on the right, after on the left.</p>
  <div class="ba-grid">

    <div>
      <div class="ba-slider-wrap" id="slider1">
        <div class="ba-canvas">
          <div class="ba-before c2 ph" style="position:absolute;inset:0;height:100%;"></div>
          <div class="ba-after c1 ph" style="position:absolute;inset:0;height:100%;clip-path:inset(0 50% 0 0);"></div>
        </div>
        <div class="ba-handle" id="handle1">
          <div class="ba-handle-circle">⟺</div>
        </div>
      </div>
      <div class="ba-labels">
        <div><div class="ba-label">After</div><div class="ba-svc-name">StrokeBlend™ Combo</div></div>
        <div style="text-align:right;"><div class="ba-label">Before</div></div>
      </div>
    </div>

    <div>
      <div class="ba-slider-wrap" id="slider2">
        <div class="ba-canvas">
          <div class="ba-before c4 ph" style="position:absolute;inset:0;height:100%;"></div>
          <div class="ba-after c3 ph" style="position:absolute;inset:0;height:100%;clip-path:inset(0 50% 0 0);"></div>
        </div>
        <div class="ba-handle" id="handle2">
          <div class="ba-handle-circle">⟺</div>
        </div>
      </div>
      <div class="ba-labels">
        <div><div class="ba-label">After</div><div class="ba-svc-name">Henna Brows</div></div>
        <div style="text-align:right;"><div class="ba-label">Before</div></div>
      </div>
    </div>

  </div>
</section>

<!-- ═══ FIND YOUR BROW CTA ═══════════════════════════════════════ -->
<section class="quiz-cta">
  <div class="quiz-text">
    <h2>Not sure which<br>brow is <em>yours?</em></h2>
    <p>Answer 3 quick questions and we'll match you with the perfect service for your skin type, lifestyle, and desired look. No guessing required.</p>
    <a href="service-quiz.html" class="btn-primary">Take the Brow Quiz</a>
  </div>
  <div class="quiz-steps">
    <div class="quiz-step">
      <div class="quiz-step-num">1</div>
      <div><div class="quiz-step-name">Your skin type</div><div class="quiz-step-text">Oily, dry, combination — it changes which technique works best.</div></div>
    </div>
    <div class="quiz-step">
      <div class="quiz-step-num">2</div>
      <div><div class="quiz-step-name">Your lifestyle</div><div class="quiz-step-text">How much time do you want to spend on brows each morning?</div></div>
    </div>
    <div class="quiz-step">
      <div class="quiz-step-num">3</div>
      <div><div class="quiz-step-name">Your desired look</div><div class="quiz-step-text">Natural and soft, bold and defined, or somewhere in between.</div></div>
    </div>
  </div>
</section>

<?php get_footer(); ?>