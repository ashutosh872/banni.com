<?php
$content = '<div style="max-width: 800px;margin: 0 auto;text-align: left">
    <p class="lead" style="font-size: 1.2rem;color: var(--color-primary-dark);font-weight: 500;line-height: 1.8;margin-bottom: 24px">
        Rooted in the timeless textile traditions of India, <strong>Saaj of Banni</strong> was born from a simple design philosophy: <em>Nothing Loud. Nothing Bland. Just Pure Cotton.</em>
    </p>

    <h2 style="font-family: var(--font-brand);color: var(--color-primary-dark);margin: 30px 0 16px">Breathable Luxury for Everyday Living</h2>
    <p>
        In an era of fast fashion, synthetic polyester, and fleeting trends, we choose natural comfort. Every kurti in our collection is crafted from 100% pure long-staple cotton, handpicked cambric, and artisanal hand-block fabrics sourced from heritage textile hubs across Jaipur, Ahmedabad, and Bagru.
    </p>
    <p>
        Our silhouettes celebrate the modern Indian woman—whether you are heading to university, spending long hours at your workplace desk, or celebrating intimate family festivities. We craft cuts that flatter without constriction, offering tailored comfort from morning meetings to evening chai.
    </p>

    <div style="display: grid;grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));gap: 20px;margin: 35px 0">
        <div style="background: var(--color-bg-gray);padding: 24px;border-radius: 12px;border: 1px solid var(--color-border)">
            <h4 style="font-family: var(--font-brand);color: var(--color-primary-dark);margin-bottom: 8px">100% Pure Cotton</h4>
            <p style="font-size: 0.9rem;color: #666;margin: 0">Zero synthetic poly blends. Breathable, sweat-absorbent, and pre-shrunk for an enduring fit.</p>
        </div>
        <div style="background: var(--color-bg-gray);padding: 24px;border-radius: 12px;border: 1px solid var(--color-border)">
            <h4 style="font-family: var(--font-brand);color: var(--color-primary-dark);margin-bottom: 8px">Ethical Craftsmanship</h4>
            <p style="font-size: 0.9rem;color: #666;margin: 0">Supporting multigenerational craftspersons and local tailors with fair wages and safe workshops.</p>
        </div>
        <div style="background: var(--color-bg-gray);padding: 24px;border-radius: 12px;border: 1px solid var(--color-border)">
            <h4 style="font-family: var(--font-brand);color: var(--color-primary-dark);margin-bottom: 8px">Thoughtful Tailoring</h4>
            <p style="font-size: 0.9rem;color: #666;margin: 0">Reinforced side slits, deep pockets, generous seam allowances, and skin-friendly azo-free dyes.</p>
        </div>
    </div>

    <h2 style="font-family: var(--font-brand);color: var(--color-primary-dark);margin: 30px 0 16px">The Corset Back &amp; Flared Cuts</h2>
    <p>
        Our signature innovation—the adjustable corset-back kurti—marries Victorian tailoring with Indian kurtis, giving you a custom hourglass drape without feeling tight. From boat necks to square necks and breezy flared hems, we obsess over every centimeter.
    </p>
    <p style="text-align: center;margin-top: 40px">
        <a href="/collections/all/" class="btn" style="background: var(--color-primary);color: #fff;padding: 14px 32px;border-radius: 8px;text-decoration: none;font-weight: 600;display: inline-block">Explore the Collection →</a>
    </p>
</div>';

wp_update_post( array(
    'ID' => 24,
    'post_content' => $content,
) );
echo "Updated About page 24 successfully.\n";
