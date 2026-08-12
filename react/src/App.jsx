import { useState, useEffect, useRef, useCallback } from 'react'

function SectionMorphStyles() {
  useEffect(() => {
    const variants = ['cv-slide-up', 'cv-zoom', 'cv-blur', 'cv-slide-left', 'cv-flip', 'cv-slide-right', 'cv-fade']
    const sections = Array.from(document.querySelectorAll('section[id]'))
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('morph-in')
          }
        })
      },
      { threshold: 0.05, rootMargin: '0px 0px -60px 0px' }
    )
    sections.forEach((s, i) => {
      s.classList.add('morph-appear', variants[i % variants.length])
      observer.observe(s)
    })
    return () => observer.disconnect()
  }, [])

  return null
}

function Separator() {
  return (
    <div className="section-sep" aria-hidden="true">
      <span className="section-sep-line"/>
      <span className="section-sep-badge">
        <svg className="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
          <path strokeLinecap="round" strokeLinejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
        </svg>
      </span>
      <span className="section-sep-line"/>
    </div>
  )
}

function App() {
  const [data, setData] = useState(null)
  const [loading, setLoading] = useState(true)

  useEffect(() => {
    fetch('/api/home')
      .then(r => r.json())
      .then(d => { setData(d); setLoading(false) })
      .catch(() => setLoading(false))
  }, [])

  if (loading) return (
    <div className="min-h-screen flex items-center justify-center bg-night-ink">
      <div className="w-12 h-12 border-4 border-eager-green/30 border-t-eager-green rounded-full animate-spin"/>
    </div>
  )

  if (!data) return (
    <div className="min-h-screen flex items-center justify-center bg-night-ink text-white">
      <p>Gagal memuat data.</p>
    </div>
  )

  return (
    <div className="min-h-screen bg-paper-white font-sans text-charcoal">
      <SectionMorphStyles />
      <Navbar settings={data.settings} />
      <Hero settings={data.settings} />
      <DoneCarousel />
      <SectionGaleri galleries={data.galleries} specifications={data.specifications} pricelists={data.pricelists} />
      <Separator />
      <SectionHandover handovers={data.handovers} />
      <Separator />
      <SectionSiteplan siteplans={data.siteplans} />
      <Separator />
      <SectionTerjual units={data.units} totalUnits={data.totalUnits} soldUnits={data.soldUnits} bookedUnits={data.bookedUnits} availableUnits={data.availableUnits} perTipe={data.perTipe} />
      <Separator />
      <SectionSpek specifications={data.specifications} />
      <Separator />
      <SectionBrosur brochures={data.brochures} />
      <Separator />
      <SectionPricelist pricelists={data.pricelists} />
      <Separator />
      <SectionLokasi />
      <Separator />
      <SectionKontak settings={data.settings} />
      <Footer settings={data.settings} />
      <WaFloat settings={data.settings} />
    </div>
  )
}

// ============ HOOKS ============
function useScrollReveal(threshold = 0.08) {
  const ref = useRef(null)
  const [visible, setVisible] = useState(false)
  useEffect(() => {
    const el = ref.current
    if (!el) return
    const obs = new IntersectionObserver(([e]) => { if (e.isIntersecting) { setVisible(true); obs.disconnect() } }, { threshold, rootMargin: '0px 0px -40px 0px' })
    obs.observe(el)
    return () => obs.disconnect()
  }, [threshold])
  return [ref, visible]
}

// ============ NAVBAR ============
function Navbar({ settings }) {
  const [open, setOpen] = useState(false)
  const [scrolled, setScrolled] = useState(false)
  const wa = (settings.whatsapp || '').replace(/[^0-9]/g, '')
  const menu = [
    ['foto-rumah', 'Foto Rumah'],
    ['serah-terima', 'Serah Terima'],
    ['siteplan', 'Siteplan'],
    ['terjual', 'Rumah Terjual'],
    ['spek', 'Spesifikasi'],
    ['brosur', 'Brosur'],
    ['pricelist', 'Pricelist'],
    ['lokasi', 'Lokasi'],
  ]

  useEffect(() => {
    const h = () => setScrolled(window.scrollY > 20)
    window.addEventListener('scroll', h, { passive: true })
    return () => window.removeEventListener('scroll', h)
  }, [])

  return (
    <header className={`sticky top-0 z-50 transition-all duration-300 ${scrolled ? 'bg-paper-white/95 backdrop-blur-xl shadow-sm border-b border-faded-gray/20' : 'bg-paper-white/80 backdrop-blur-xl border-b border-faded-gray/20'}`}>
      <nav className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-16 lg:h-[72px]">
          <a href="#beranda" className="flex items-center gap-3 group">
            <img src="/images/logo-gua3.jpg" alt="Logo GUA 3" className="w-11 h-11 rounded-full object-cover shadow-lg shadow-eager-green/20 group-hover:shadow-eager-green/40 transition-shadow group-hover:scale-105 transition"/>
            <span className="text-sm font-extrabold tracking-widest text-night-ink">GRIYA UTAMA ASRI 3</span>
          </a>
          <div className="hidden lg:flex items-center gap-0.5">
            {menu.map(([id, label]) => (
              <a key={id} href={`#${id}`} className="px-2.5 py-2 text-sm font-semibold text-charcoal hover:text-eager-green rounded-xl hover:bg-eager-green/10 transition-all duration-200">{label}</a>
            ))}
            <a href="#kontak" className="px-2.5 py-2 text-sm font-semibold text-charcoal hover:text-eager-green rounded-xl hover:bg-eager-green/10 transition-all duration-200">Kontak</a>
            <a href={`https://wa.me/${wa}`} target="_blank" rel="noopener" className="ml-2 btn-eager text-sm !py-2.5 !px-5 inline-flex items-center gap-2">
              <svg className="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
              WhatsApp
            </a>
          </div>
          <button onClick={() => setOpen(!open)} className="lg:hidden p-2 rounded-xl text-charcoal hover:bg-eager-green/10 transition" aria-label="Menu">
            {open
              ? <svg className="w-6 h-6" fill="none" stroke="currentColor" strokeWidth="2.5" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
              : <svg className="w-6 h-6" fill="none" stroke="currentColor" strokeWidth="2.5" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5"/></svg>
            }
          </button>
        </div>
        {open && (
          <div className="lg:hidden pb-4 border-t border-faded-gray/20 mt-1">
            <div className="flex flex-col gap-1 pt-3">
              {menu.map(([id, label]) => (
                <a key={id} href={`#${id}`} onClick={() => setOpen(false)} className="px-4 py-3 text-sm font-semibold text-charcoal hover:bg-eager-green/10 hover:text-eager-green rounded-xl transition-all">{label}</a>
              ))}
              <a href="#kontak" onClick={() => setOpen(false)} className="px-4 py-3 text-sm font-semibold text-charcoal hover:bg-eager-green/10 hover:text-eager-green rounded-xl transition-all">Kontak</a>
              <a href={`https://wa.me/${wa}`} target="_blank" rel="noopener" className="mt-2 btn-eager text-center text-sm">Hubungi via WhatsApp</a>
            </div>
          </div>
        )}
      </nav>
    </header>
  )
}

// ============ HERO ============
function Hero({ settings }) {
  const wa = (settings.whatsapp || '').replace(/[^0-9]/g, '')
  return (
    <section id="beranda" className="relative overflow-hidden bg-gradient-to-br from-night-ink via-[#0f2818] to-[#132e1c] text-white min-h-screen flex flex-col">
      <div className="absolute top-20 left-10 w-72 h-72 bg-eager-green/10 rounded-full blur-3xl float-anim-slow"/>
      <div className="absolute inset-0" style={{maskImage:'linear-gradient(to right, transparent 0%, black 40%)', WebkitMaskImage:'linear-gradient(to right, transparent 0%, black 40%)'}}>
        <img src="/images/foto-rumah-depan.png" alt="Rumah Griya Utama Asri 3" className="absolute inset-0 w-full h-full object-cover object-bottom sm:object-center opacity-40 lg:opacity-100"/>
      </div>
      <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 lg:py-28 w-full flex-1 flex items-center">
        <div className="w-full lg:max-w-xl">
          <h1 className="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold leading-[1.1] tracking-tight">
            GRIYA UTAMA<br/><span className="gradient-text">ASRI 3</span>
          </h1>
          <p className="mt-5 sm:mt-6 text-base sm:text-lg text-white/70 max-w-lg leading-relaxed">
            {settings.tagline || 'Hunian modern dengan suasana asri dan hijau.'}
          </p>
          <div className="mt-8 sm:mt-10 flex flex-wrap items-center gap-3 sm:gap-4">
            <a href={`https://wa.me/${wa}`} target="_blank" rel="noopener" className="btn-eager text-sm sm:text-base inline-flex items-center gap-2">Konsultasi Gratis</a>
            <a href="#pricelist" className="btn-spark text-sm sm:text-base inline-flex items-center gap-2">Lihat Pricelist</a>
          </div>
        </div>
      </div>
    </section>
  )
}

// ============ SECTION HEADING ============
function SectionHeading({ subtitle, title, color = 'eager-green', desc }) {
  const [ref, vis] = useScrollReveal()
  return (
    <div ref={ref} className={`mb-14 text-center transition-all duration-700 ${vis ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'}`}>
      {subtitle && <span className={`inline-block text-${color} text-sm font-bold tracking-widest uppercase mb-3`}>{subtitle}</span>}
      <h2 className="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-night-ink">{title}</h2>
      <div className={`mt-4 mx-auto h-1.5 w-20 bg-gradient-to-r from-eager-green to-spark-blue rounded-full`}/>
      {desc && <p className="mt-5 text-pencil-gray max-w-2xl mx-auto leading-relaxed">{desc}</p>}
    </div>
  )
}

function DarkSectionHeading({ subtitle, title, desc }) {
  const [ref, vis] = useScrollReveal()
  return (
    <div ref={ref} className={`mb-14 text-center transition-all duration-700 ${vis ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'}`}>
      {subtitle && <span className="inline-block text-eager-green text-sm font-bold tracking-widest uppercase mb-3">{subtitle}</span>}
      <h2 className="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white">{title}</h2>
      <div className="mt-4 mx-auto h-1.5 w-20 bg-gradient-to-r from-eager-green to-spark-blue rounded-full"/>
      {desc && <p className="mt-5 text-white/60 max-w-2xl mx-auto leading-relaxed">{desc}</p>}
    </div>
  )
}

// ============ DONE CAROUSEL ============
function DoneCarousel() {
  const images = [
    '/images/1 done.png',
    '/images/2 done.png',
    '/images/4 done.png',
    '/images/16 done.png',
    '/images/17 done.png',
    '/images/25 done.png',
    '/images/26 done.png',
  ]
  const [current, setCurrent] = useState(0)
  const prev = (current - 1 + images.length) % images.length
  const next = (current + 1) % images.length

  useEffect(() => {
    const timer = setInterval(() => {
      setCurrent(c => (c + 1) % images.length)
    }, 6000)
    return () => clearInterval(timer)
  }, [])

  return (
    <section className="relative py-12 lg:py-16 bg-white overflow-hidden border-t border-b border-gray-200">
      <div className="absolute inset-y-0 left-0 w-40 sm:w-64 lg:w-96">
        <img src={images[prev]} alt="" loading="lazy" className="w-full h-full object-cover opacity-25 blur-[2px] pointer-events-none select-none"/>
        <div className="absolute inset-0 bg-gradient-to-r from-white to-transparent"/>
      </div>
      <div className="absolute inset-y-0 right-0 w-40 sm:w-64 lg:w-96">
        <img src={images[next]} alt="" loading="lazy" className="w-full h-full object-cover opacity-25 blur-[2px] pointer-events-none select-none"/>
        <div className="absolute inset-0 bg-gradient-to-l from-white to-transparent"/>
      </div>

      <div className="relative mx-auto max-w-5xl px-4 sm:px-6">
        <div className="relative w-full h-[40vw] sm:h-[30vw] lg:h-[24vw]">
          {images.map((src, i) => (
            <div key={i} className={`absolute inset-0 flex items-center justify-center transition-opacity duration-1500 ease-in-out ${i === current ? 'opacity-100' : 'opacity-0'}`}>
              <img src={src} alt="Progress Griya Utama Asri 3" loading="lazy" className="max-w-full max-h-full object-contain drop-shadow-xl pointer-events-none select-none"/>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}

// ============ GALLERY ============
function SectionGaleri({ galleries, specifications, pricelists }) {
  const [current, setCurrent] = useState(0)

  useEffect(() => {
    if (!galleries.length) return
    const timer = setInterval(() => setCurrent(c => (c + 1) % galleries.length), 5000)
    return () => clearInterval(timer)
  }, [galleries.length])

  return (
    <section id="foto-rumah" className="py-20 lg:py-28">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <SectionHeading subtitle="Galeri" title="Foto Rumah" desc="Lihat langsung seperti apa hunian idaman di Griya Utama Asri 3. Setiap foto menampilkan detail eksterior dan suasana lingkungan perumahan kami."/>
        {galleries.length > 0 ? (
          <div className="relative rounded-3xl border-2 border-faded-gray/20 bg-paper-white overflow-hidden">
            <div className="relative h-[55vw] sm:h-[45vw] lg:h-[34vw] bg-night-ink">
              {galleries.map((item, i) => (
                <div key={i} className={`absolute inset-0 flex items-center justify-center transition-opacity duration-700 ease-in-out ${i === current ? 'opacity-100' : 'opacity-0'}`}>
                  <img src={item.image} alt={item.title} loading="lazy" className="max-w-full max-h-full object-contain pointer-events-none select-none"/>
                </div>
              ))}
            </div>

            <button onClick={() => setCurrent(c => (c - 1 + galleries.length) % galleries.length)} aria-label="Sebelumnya"
              className="absolute left-3 sm:left-5 top-1/2 -translate-y-1/2 w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-white/90 hover:bg-white text-night-ink shadow-lg flex items-center justify-center text-2xl font-bold transition-transform hover:scale-110 z-10">
              &#8249;
            </button>
            <button onClick={() => setCurrent(c => (c + 1) % galleries.length)} aria-label="Berikutnya"
              className="absolute right-3 sm:right-5 top-1/2 -translate-y-1/2 w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-white/90 hover:bg-white text-night-ink shadow-lg flex items-center justify-center text-2xl font-bold transition-transform hover:scale-110 z-10">
              &#8250;
            </button>

            <div className="absolute bottom-3 sm:bottom-4 left-1/2 -translate-x-1/2 flex items-center gap-2 z-10">
              {galleries.map((_, i) => (
                <button key={i} onClick={() => setCurrent(i)} aria-label={`Foto ${i + 1}`}
                  className={`w-2.5 h-2.5 rounded-full bg-white/40 transition-all duration-300 ${i === current ? 'bg-white w-6' : ''}`}></button>
              ))}
            </div>
          </div>
        ) : <p className="text-center text-pencil-gray">Belum ada foto rumah.</p>}
      </div>
    </section>
  )
}

// ============ HANDOVER ============
function SectionHandover({ handovers }) {
  return (
    <section id="serah-terima" className="py-20 lg:py-28 bg-gradient-to-br from-eager-green/10 via-spark-blue/5 to-fresh-leaf/10">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <SectionHeading subtitle="Dokumentasi" title="Serah Terima Kunci" color="spark-blue" desc="Momen bahagia saat kunci rumah resmi diserahkan kepada pemilik baru. Ini adalah bukti nyata komitmen kami dalam mewujudkan hunian impian Anda."/>
        {handovers.length > 0 ? (
          <div className="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
            {handovers.map((item, i) => (
              <div key={i} className="card-hover rounded-3xl overflow-hidden bg-paper-white border-2 border-faded-gray/20">
                <div className="img-zoom"><img src={item.image} alt={item.title} loading="lazy" className="w-full h-72 object-cover"/></div>
                <div className="p-6">
                  <h3 className="text-lg font-bold text-night-ink">{item.title}</h3>
                  {item.description && <p className="mt-2 text-sm text-pencil-gray">{item.description}</p>}
                </div>
              </div>
            ))}
          </div>
        ) : <p className="text-center text-pencil-gray">Belum ada dokumentasi serah terima kunci.</p>}
      </div>
    </section>
  )
}

// ============ SITEPLAN ============
function SectionSiteplan({ siteplans }) {
  return (
    <section id="siteplan" className="py-20 lg:py-28">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <SectionHeading subtitle="Siteplan" title="Siteplan" desc="Pelajari tata letak seluruh kavling di Griya Utama Asri 3. Setiap blok dirancang dengan akses jalan yang lebar dan tata ruang yang terencana."/>
        <p className="text-center text-pencil-gray max-w-2xl mx-auto leading-relaxed mb-10">Layout lengkap nomor kavling perumahan Griya Utama Asri 3, total 85 unit.</p>
        <div className="mb-10 flex justify-center">
          <div className="card-hover rounded-3xl overflow-hidden bg-paper-white border-2 border-faded-gray/20 max-w-2xl w-full">
            <div className="img-zoom p-4"><img src="/images/Siteplan GUA3.jpg" alt="Siteplan" loading="lazy" className="w-full h-auto rounded-2xl"/></div>
            <div className="p-6">
              <h3 className="text-lg font-bold text-night-ink">Siteplan Griya Utama Asri 3</h3>
              <p className="mt-2 text-sm text-pencil-gray">Klik untuk memperbesar gambar siteplan.</p>
            </div>
          </div>
        </div>
        {siteplans.length > 0 && (
          <div className="grid gap-8 sm:grid-cols-2 lg:grid-cols-2 max-w-4xl mx-auto">
            {siteplans.map((sp, i) => (
              <div key={i} className="card-hover rounded-3xl overflow-hidden bg-paper-white border-2 border-faded-gray/20">
                <div className="img-zoom bg-gradient-to-br from-eager-green/5 to-spark-blue/5 p-4"><img src={sp.image} alt={sp.title} loading="lazy" className="w-full h-auto rounded-2xl"/></div>
                <div className="p-6">
                  <h3 className="text-lg font-bold text-night-ink">{sp.title}</h3>
                  {sp.description && <p className="mt-2 text-sm text-pencil-gray leading-relaxed">{sp.description}</p>}
                </div>
              </div>
            ))}
          </div>
        )}
      </div>
    </section>
  )
}

// ============ TERJUAL (DASHBOARD) ============
function SectionTerjual({ units, totalUnits, soldUnits, bookedUnits, availableUnits, perTipe }) {
  const persen = totalUnits > 0 ? Math.round(soldUnits / totalUnits * 100) : 0
  const [ringReady, setRingReady] = useState(false)
  const [countDone, setCountDone] = useState(false)

  useEffect(() => {
    const t1 = setTimeout(() => setRingReady(true), 400)
    const t2 = setTimeout(() => setCountDone(true), 800)
    return () => { clearTimeout(t1); clearTimeout(t2) }
  }, [])

  return (
    <section id="terjual" className="py-20 lg:py-28 bg-white">
      <div className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <SectionHeading subtitle="Dashboard" title="Rumah Terjual" desc="Pantau progres penjualan unit Griya Utama Asri 3 secara real-time."/>

        {/* Stat Cards */}
        <div className="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-12">
          <div className="rounded-2xl bg-night-ink p-5 text-white">
            <p className="text-sm text-white/60 font-medium mb-1">Total Unit</p>
            <p className="text-3xl font-extrabold">{countDone ? totalUnits : 0}</p>
          </div>
          <div className="rounded-2xl bg-[#dcfce7] p-5">
            <p className="text-sm text-eager-green/70 font-medium mb-1">Terjual</p>
            <p className="text-3xl font-extrabold text-eager-green">{countDone ? soldUnits : 0}</p>
          </div>
          <div className="rounded-2xl bg-[#fef9c3] p-5">
            <p className="text-sm text-amber-600/70 font-medium mb-1">Dipesan</p>
            <p className="text-3xl font-extrabold text-amber-600">{countDone ? bookedUnits : 0}</p>
          </div>
          <div className="rounded-2xl bg-[#e0f2fe] p-5">
            <p className="text-sm text-sky-600/70 font-medium mb-1">Tersedia</p>
            <p className="text-3xl font-extrabold text-sky-600">{countDone ? availableUnits : 0}</p>
          </div>
        </div>

        {/* Progress Ring + Bar */}
        <div className="flex flex-col lg:flex-row items-center gap-8 mb-12">
          <div className="shrink-0">
            <div className="relative w-40 h-40 sm:w-48 sm:h-48">
              <svg className="w-full h-full -rotate-90" viewBox="0 0 120 120">
                <circle cx="60" cy="60" r="52" fill="none" stroke="#f1f5f9" strokeWidth="8"/>
                <circle cx="60" cy="60" r="52" fill="none" stroke="url(#grad-ring)" strokeWidth="8" strokeLinecap="round" strokeDasharray="326.73" strokeDashoffset={ringReady ? 326.73 - (persen / 100) * 326.73 : 326.73} className="progress-ring"/>
                <defs><linearGradient id="grad-ring" x1="0%" y1="0%" x2="100%" y2="0%"><stop offset="0%" stopColor="#22c55e"/><stop offset="100%" stopColor="#16a34a"/></linearGradient></defs>
              </svg>
              <div className="absolute inset-0 flex flex-col items-center justify-center">
                <span className="text-4xl sm:text-5xl font-extrabold text-night-ink">{countDone ? persen : 0}</span>
                <span className="text-xs text-pencil-gray font-medium mt-1">% terjual</span>
              </div>
            </div>
          </div>
          <div className="flex-1 w-full">
            <p className="text-sm font-bold text-night-ink mb-3">Komposisi</p>
            <div className="h-3 bg-gray-100 rounded-full overflow-hidden flex">
              <div className="bg-[#4ade80] transition-all duration-1000" style={{width: `${persen}%`}}/>
              <div className="bg-[#fbbf24] transition-all duration-1000" style={{width: `${totalUnits > 0 ? Math.round(bookedUnits / totalUnits * 100) : 0}%`}}/>
              <div className="bg-[#38bdf8] transition-all duration-1000" style={{width: `${totalUnits > 0 ? Math.round(availableUnits / totalUnits * 100) : 0}%`}}/>
            </div>
            <div className="flex flex-wrap gap-5 mt-4 text-sm">
              <span className="flex items-center gap-2"><span className="w-2.5 h-2.5 rounded-full bg-[#4ade80]"/> Terjual <strong className="text-night-ink">{soldUnits}</strong></span>
              <span className="flex items-center gap-2"><span className="w-2.5 h-2.5 rounded-full bg-[#fbbf24]"/> Dipesan <strong className="text-night-ink">{bookedUnits}</strong></span>
              <span className="flex items-center gap-2"><span className="w-2.5 h-2.5 rounded-full bg-[#38bdf8]"/> Tersedia <strong className="text-night-ink">{availableUnits}</strong></span>
            </div>
          </div>
        </div>

        {/* Per Type */}
        <div className="grid sm:grid-cols-2 gap-4 mb-10">
          {perTipe.map((t, i) => {
            const p = t.total > 0 ? Math.round(t.terjual / t.total * 100) : 0
            return (
              <div key={i} className="rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 hover:shadow-lg transition-shadow">
                <div className="flex items-center justify-between mb-4">
                  <h4 className="font-bold text-night-ink text-lg">{t.type}</h4>
                  <span className="text-sm font-bold text-eager-green">{p}%</span>
                </div>
                <div className="h-2 bg-gray-100 rounded-full overflow-hidden mb-4 flex">
                  <div className="bg-[#4ade80] transition-all duration-700" style={{width: ringReady ? `${p}%` : '0%'}}/>
                  <div className="bg-[#fbbf24] transition-all duration-700" style={{width: ringReady ? `${t.total > 0 ? Math.round(t.dipesan / t.total * 100) : 0}%` : '0%'}}/>
                  <div className="bg-[#38bdf8] transition-all duration-700" style={{width: ringReady ? `${t.total > 0 ? Math.round(t.tersedia / t.total * 100) : 0}%` : '0%'}}/>
                </div>
                <div className="flex gap-4 text-sm text-pencil-gray">
                  <span><strong className="text-[#22c55e]">{t.terjual}</strong> terjual</span>
                  <span><strong className="text-amber-500">{t.dipesan}</strong> dipesan</span>
                  <span><strong className="text-sky-500">{t.tersedia}</strong> tersedia</span>
                </div>
              </div>
            )
          })}
        </div>

        {/* Unit Grid */}
        <div className="rounded-2xl border border-gray-200 bg-white overflow-hidden">
          <div className="px-5 sm:px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 className="font-bold text-night-ink">Daftar Unit</h3>
            <div className="flex items-center gap-3 text-xs text-pencil-gray">
              <span className="flex items-center gap-1.5"><span className="w-2 h-2 rounded-full bg-[#4ade80]"/> Terjual</span>
              <span className="flex items-center gap-1.5"><span className="w-2 h-2 rounded-full bg-[#fbbf24]"/> Dipesan</span>
              <span className="flex items-center gap-1.5"><span className="w-2 h-2 rounded-full bg-[#38bdf8]"/> Tersedia</span>
            </div>
          </div>
          <div className="p-5 sm:p-6">
            <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2.5">
              {units.map((u, i) => {
                const c = u.status === 'terjual' ? '#22c55e' : u.status === 'dipesan' ? '#f59e0b' : '#0ea5e9'
                return (
                  <div key={i} className="flex items-center gap-2.5 px-3 py-2.5 rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors">
                    <span className="w-2 h-2 rounded-full shrink-0" style={{background: c}}/>
                    <div className="min-w-0 flex-1">
                      <p className="text-sm font-bold text-night-ink truncate">{u.block}</p>
                      <p className="text-[11px] text-pencil-gray truncate">{u.type}</p>
                    </div>
                  </div>
                )
              })}
            </div>
          </div>
        </div>
      </div>
    </section>
  )
}

function StatusPill({ label, count, color, ready }) {
  return (
    <div className="flex items-center gap-3 px-5 py-3 rounded-2xl border" style={{backgroundColor: `${color}15`, borderColor: `${color}30`}}>
      <span className="w-3 h-3 rounded-full" style={{backgroundColor: color}}/>
      <span className="text-sm font-semibold text-white/90">{label}</span>
      <span className="text-xl font-extrabold" style={{color}}>{ready ? count : 0}</span>
    </div>
  )
}

// ============ SPEK ============
function SectionSpek({ specifications }) {
  const iconMap = {
    'Struktur & Pondasi': { from: '#f59e0b', to: '#fb923c', icon: <path strokeLinecap="round" strokeLinejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/> },
    'Atap': { from: '#ef4444', to: '#f87171', icon: <path strokeLinecap="round" strokeLinejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/> },
    'Lantai': { from: '#06b6d4', to: '#22d3ee', icon: <path strokeLinecap="round" strokeLinejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/> },
    'Plafon': { from: '#0ea5e9', to: '#38bdf8', icon: <path strokeLinecap="round" strokeLinejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/> },
    'Pintu & Jendela': { from: '#6366f1', to: '#818cf8', icon: <path strokeLinecap="round" strokeLinejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z"/> },
    'Elektrikal': { from: '#eab308', to: '#facc15', icon: <path strokeLinecap="round" strokeLinejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/> },
    'Sanitasi': { from: '#3b82f6', to: '#60a5fa', icon: <path strokeLinecap="round" strokeLinejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/> },
    'Fasilitas': { from: '#10b981', to: '#34d399', icon: <path strokeLinecap="round" strokeLinejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z"/> },
  }

  return (
    <section id="spek" className="py-20 lg:py-28 bg-gradient-to-br from-eager-green/5 via-transparent to-spark-blue/5">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <SectionHeading subtitle="Kualitas Terjamin" title="Spesifikasi Bangunan" color="spark-blue" desc="Setiap unit dibangun dengan material pilihan dan mengikuti standar konstruksi terbaik. Kenali detail spesifikasi yang kami gunakan."/>
        <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
          {Object.entries(specifications).map(([cat, items]) => {
            const s = iconMap[cat] || { from: '#2d6a3a', to: '#8fce6a', icon: null }
            return (
              <div key={cat} className="card-hover rounded-3xl border-2 border-faded-gray/20 bg-paper-white p-7 transition-all duration-300">
                <div className="flex items-center gap-3 mb-6">
                  <div className="w-12 h-12 rounded-2xl flex items-center justify-center shadow-lg" style={{background:`linear-gradient(135deg, ${s.from}, ${s.to})`, boxShadow:`0 4px 14px -3px ${s.from}40`}}>
                    <svg className="w-6 h-6 text-white" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24">{s.icon}</svg>
                  </div>
                  <h3 className="text-lg font-bold text-night-ink">{cat}</h3>
                </div>
                <dl className="space-y-3">
                  {items.map((it, j) => (
                    <div key={j} className="flex justify-between gap-4 text-sm py-2 border-b border-faded-gray/10 last:border-0">
                      <dt className="text-pencil-gray">{it.name}</dt>
                      <dd className="font-bold text-night-ink text-right">{it.value}</dd>
                    </div>
                  ))}
                </dl>
              </div>
            )
          })}
        </div>
      </div>
    </section>
  )
}

// ============ BROSUR ============
function SectionBrosur({ brochures }) {
  const [current, setCurrent] = useState(0)
  const [modalImg, setModalImg] = useState(null)
  const total = brochures.length
  const pdfUrl = total > 0 ? `/storage/${brosures[0].file}` : '#'

  useEffect(() => {
    if (total <= 1) return
    const t = setInterval(() => setCurrent(c => (c + 1) % total), 4000)
    return () => clearInterval(t)
  }, [total])

  if (!total) return (
    <section id="brosur" className="py-20 lg:py-28">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <SectionHeading subtitle="" title="Brosur" desc="Unduh brosur lengkap Griya Utama Asri 3 dalam format PDF. Berisi informasi detail tipe rumah, harga, hingga siteplan."/>
        <p className="text-center text-pencil-gray">Belum ada brosur.</p>
      </div>
    </section>
  )

  return (
    <section id="brosur" className="py-20 lg:py-28">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <SectionHeading subtitle="" title="Brosur" desc="Unduh brosur lengkap Griya Utama Asri 3 dalam format PDF. Berisi informasi detail tipe rumah, harga, hingga siteplan."/>
        <div className="relative rounded-3xl overflow-hidden border-2 border-faded-gray/20 shadow-xl bg-night-ink aspect-[4/3] sm:aspect-[16/9] lg:aspect-[21/9]">
          {brosures && brosures.map((b, i) => (
            <div key={i} className={`absolute inset-0 transition-opacity duration-700 ${i === current ? 'opacity-100' : 'opacity-0 pointer-events-none'}`}>
              <img src={b.cover} alt={b.title} className="w-full h-full object-contain cursor-pointer" onClick={() => setModalImg(b.cover)}/>
            </div>
          ))}
          <div className="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-night-ink/80 to-transparent p-6 pointer-events-none">
            <p className="text-white font-bold text-lg">{brosures[current]?.title}</p>
            <p className="text-white/60 text-sm">{brosures[current]?.description}</p>
          </div>
          {total > 1 && <>
            <button onClick={() => { setCurrent(c => (c - 1 + total) % total) }} className="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-sm flex items-center justify-center text-white font-bold text-lg">‹</button>
            <button onClick={() => { setCurrent(c => (c + 1) % total) }} className="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-sm flex items-center justify-center text-white font-bold text-lg">›</button>
          </>}
          <div className="absolute bottom-6 right-6 flex gap-2 z-10">
            {brosures.map((_, i) => (
              <button key={i} onClick={() => setCurrent(i)} className={`w-3 h-3 rounded-full transition-all duration-300 ${i === current ? 'bg-eager-green w-8' : 'bg-white/40 hover:bg-white/70'}`}/>
            ))}
          </div>
        </div>
        <div className="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4 rounded-2xl bg-gradient-to-r from-night-ink to-[#0f2818] p-5">
          <div className="flex items-center gap-3">
            <div className="w-10 h-10 rounded-xl bg-red-500 flex items-center justify-center text-white shadow-lg shadow-red-500/30">
              <svg className="w-5 h-5" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
            </div>
            <div>
              <p className="text-white font-bold">Download Brosur PDF</p>
            </div>
          </div>
          <a href={pdfUrl} download className="btn-eager inline-flex items-center gap-2 text-sm">Download PDF</a>
        </div>
        {modalImg && (
          <div className="fixed inset-0 z-[100] bg-night-ink/95 backdrop-blur-sm flex items-center justify-center p-4 sm:p-8" onClick={(e) => { if (e.target === e.currentTarget) setModalImg(null) }}>
            <button onClick={() => setModalImg(null)} className="absolute top-4 right-4 sm:top-6 sm:right-6 w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-white text-2xl">&times;</button>
            <img src={modalImg} alt="" className="max-w-full max-h-full object-contain rounded-2xl"/>
          </div>
        )}
      </div>
    </section>
  )
}

// ============ PRICELIST ============
function SectionPricelist({ pricelists }) {
  return (
    <section id="pricelist" className="py-20 lg:py-28 bg-gradient-to-br from-night-ink via-[#0f2818] to-[#132e1c] text-white">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <DarkSectionHeading subtitle="Harga" title="Pricelist Rumah" desc="Lihat daftar harga terbaru untuk setiap tipe rumah di Griya Utama Asri 3. Harga bisa berubah sewaktu-waktu, hubungi kami untuk informasi terkini."/>
        {pricelists.length > 0 ? (
          <div className="overflow-x-auto rounded-3xl border-2 border-eager-green/20 bg-paper-white shadow-xl">
            <table className="w-full text-sm text-left">
              <thead>
                <tr className="bg-gradient-to-r from-night-ink to-[#0f2818] text-white">
                  <th className="py-5 px-6 font-bold">Tipe</th>
                  <th className="py-5 px-6 font-bold">Luas Tanah</th>
                  <th className="py-5 px-6 font-bold">Luas Bangunan</th>
                  <th className="py-5 px-6 font-bold text-right">Harga</th>
                  <th className="py-5 px-6 font-bold"></th>
                </tr>
              </thead>
              <tbody>
                {pricelists.map((pl, i) => {
                  const hargaFinal = pl.price - pl.discount
                  return (
                    <tr key={i} className="border-b border-faded-gray/10 last:border-0 hover:bg-eager-green/5 transition-colors">
                      <td className="py-5 px-6 font-bold text-night-ink">{pl.title}</td>
                      <td className="py-5 px-6 text-pencil-gray">{pl.land_area ? `${pl.land_area} m²` : '-'}</td>
                      <td className="py-5 px-6 text-pencil-gray">{pl.building_area ? `${pl.building_area} m²` : '-'}</td>
                      <td className="py-5 px-6">
                        {pl.discount > 0 ? <>
                          <span className="block text-xs text-faded-gray line-through">Rp {pl.price.toLocaleString('id-ID')}</span>
                          <span className="font-extrabold text-eager-green text-base">Rp {hargaFinal.toLocaleString('id-ID')}</span>
                        </> : <span className="font-extrabold text-night-ink text-base">Rp {pl.price.toLocaleString('id-ID')}</span>}
                      </td>
                      <td className="py-5 px-6"><a href="#kontak" className="btn-eager text-xs !py-2 !px-4">Tanya</a></td>
                    </tr>
                  )
                })}
              </tbody>
            </table>
          </div>
        ) : <p className="text-center text-white/60">Belum ada data pricelist.</p>}
      </div>
    </section>
  )
}

// ============ LOKASI ============
function SectionLokasi() {
  return (
    <section id="lokasi" className="py-20 lg:py-28">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <SectionHeading subtitle="Lokasi" title="Lokasi Kami" desc="Temukan lokasi strategis Griya Utama Asri 3 di Banjar Baru, Kalimantan Selatan. Akses mudah ke pusat kota, sekolah, dan fasilitas publik lainnya."/>
        <div className="grid lg:grid-cols-3 gap-8 items-start">
          <div className="lg:col-span-2 rounded-3xl overflow-hidden border-2 border-faded-gray/20 shadow-lg">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127672.06532329198!2d114.767397!3d-3.419557!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df67f1f28c4d4af%3A0x8db4f5b76b49e0!2sGriya%20Utama%20Asri%203!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" width="100%" height="450" style={{border:0}} allowFullScreen loading="lazy" referrerPolicy="no-referrer-when-downgrade" title="Lokasi Griya Utama Asri 3"/>
          </div>
          <div className="space-y-4">
            <div className="rounded-2xl bg-eager-green/5 border border-eager-green/10 p-5">
              <h4 className="font-bold text-night-ink mb-2">Alamat</h4>
              <p className="text-sm text-pencil-gray">HQJ8+3X, Syamsudin Noor, Kec. Landasan Ulin, Kota Banjar Baru, Kalimantan Selatan 70721</p>
            </div>
            <div className="rounded-2xl bg-eager-green/5 border border-eager-green/10 p-5">
              <h4 className="font-bold text-night-ink mb-2">Jam Operasional</h4>
              <p className="text-sm text-pencil-gray">Senin – Sabtu, 08.00 – 16.30 WITA</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  )
}

// ============ KONTAK ============
function SectionKontak({ settings }) {
  const wa = (settings.whatsapp || '').replace(/[^0-9]/g, '')
  const waLink = wa ? `https://wa.me/${wa}` : '#'
  const ig = settings.instagram || 'https://www.instagram.com/griyautamasri3?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=='
  const igLink = ig.startsWith('http') ? ig : `https://www.instagram.com/${ig}/`
  const items = [
    { label: 'Alamat', text: settings.alamat || '-', icon: <><path strokeLinecap="round" strokeLinejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path strokeLinecap="round" strokeLinejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></>, color: 'eager-green' },
    { label: 'WhatsApp', text: settings.whatsapp || '-', icon: <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>, color: 'eager-green', link: waLink },
    { label: 'Instagram', text: '@griyautamasri3', icon: <><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></>, color: 'spark-blue', link: igLink },
  ]

  return (
    <section id="kontak" className="py-20 lg:py-28 bg-gradient-to-br from-night-ink via-[#0f2818] to-[#132e1c] text-white">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <DarkSectionHeading subtitle="Penutup" title="Hubungi Kami" desc="Tim kami siap membantu Anda menemukan hunian impian. Jangan ragu untuk menghubungi kami melalui WhatsApp atau kunjungi langsung marketing office kami."/>
        <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 max-w-4xl mx-auto">
          {items.map((k, i) => (
            <div key={i} className="card-hover rounded-3xl bg-white/10 border border-white/15 p-6 backdrop-blur-sm">
              <div className={`w-12 h-12 rounded-2xl bg-${k.color}/25 text-${k.color} flex items-center justify-center mb-4`}>
                <svg className="w-6 h-6" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24">{k.icon}</svg>
              </div>
              <p className="text-sm text-white/50">{k.label}</p>
              {k.link ? <a href={k.link} target="_blank" rel="noopener" className="mt-1 font-bold text-white hover:text-eager-green transition-colors">{k.text}</a> : <p className="mt-1 font-bold text-white">{k.text}</p>}
            </div>
          ))}
        </div>
        <div className="mt-12 flex flex-col sm:flex-row items-center justify-between gap-6 rounded-3xl bg-eager-green/10 border border-eager-green/30 p-8">
          <div>
            <p className="font-bold text-eager-green text-lg">Jam Operasional</p>
            <p className="text-sm text-white/60 mt-1">{settings.jam_operasional || 'Senin – Sabtu, 08.00 – 16.30 WITA'}</p>
          </div>
          <a href={waLink} target="_blank" rel="noopener" className="btn-eager shrink-0 inline-flex items-center gap-2">
            <svg className="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
            Chat WhatsApp Sekarang
          </a>
        </div>
      </div>
    </section>
  )
}

// ============ FOOTER ============
function Footer({ settings }) {
  return (
    <footer className="bg-night-ink text-white/40 py-6">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex flex-col sm:flex-row items-center justify-between gap-4">
          <p className="text-xs text-white/30">© {new Date().getFullYear()} {settings.nama_perusahaan || 'PT. Sinar Berlian Jaya Utama'}. Hak cipta dilindungi.</p>
          <div className="flex items-center gap-3">
            <a href={`https://wa.me/${(settings.whatsapp||'').replace(/[^0-9]/g,'')}`} target="_blank" rel="noopener" className="w-8 h-8 rounded-full bg-white/10 hover:bg-eager-green/30 flex items-center justify-center transition" aria-label="WhatsApp">
              <svg className="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
            </a>
            <a href={settings.instagram || 'https://www.instagram.com/griyautamasri3?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=='} target="_blank" rel="noopener" className="w-8 h-8 rounded-full bg-white/10 hover:bg-eager-green/30 flex items-center justify-center transition" aria-label="Instagram">
              <svg className="w-4 h-4 text-white" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
            </a>
          </div>
        </div>
      </div>
    </footer>
  )
}

// ============ WA FLOAT ============
function WaFloat({ settings }) {
  const wa = (settings.whatsapp || '').replace(/[^0-9]/g, '')
  if (!wa) return null
  return (
    <a href={`https://wa.me/${wa}`} target="_blank" rel="noopener" className="fixed bottom-6 right-6 z-50 w-14 h-14 rounded-full bg-[#25D366] hover:bg-[#20b858] shadow-lg shadow-[#25D366]/30 flex items-center justify-center transition-all float-anim" aria-label="WhatsApp">
      <svg className="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
    </a>
  )
}

export default App
