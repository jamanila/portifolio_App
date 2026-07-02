import { motion } from 'framer-motion'
import Container from '@/components/common/Container'
import Button from '@/components/ui/Button'
import { useSiteData } from '@/contexts/SiteDataContext'

export default function Hero() {
  const { settings, isLoading } = useSiteData()

  return (
    <section className="relative overflow-hidden py-20 sm:py-28">
      <div
        aria-hidden
        className="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_20%_20%,rgba(99,102,241,0.15),transparent_50%),radial-gradient(circle_at_80%_0%,rgba(139,92,246,0.15),transparent_50%)]"
      />

      <Container className="grid items-center gap-12 lg:grid-cols-2">
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.5 }}
        >
          <p className="text-sm font-semibold uppercase tracking-wide text-indigo-600 dark:text-indigo-400">
            Software Developer
          </p>
          <h1 className="mt-3 text-4xl font-bold tracking-tight text-neutral-900 dark:text-white sm:text-5xl lg:text-6xl">
            {isLoading ? 'Loading…' : settings?.site_name ?? 'Your Name'}
          </h1>
          {settings?.site_title && (
            <p className="mt-4 text-xl text-neutral-600 dark:text-neutral-300">{settings.site_title}</p>
          )}
          {settings?.site_description && (
            <p className="mt-4 max-w-xl text-base text-neutral-500 dark:text-neutral-400">
              {settings.site_description}
            </p>
          )}

          <div className="mt-8 flex flex-wrap gap-4">
            <Button to="/projects" variant="primary">
              View Projects
            </Button>
            <Button to="/products" variant="secondary">
              Explore Products
            </Button>
            <Button to="/contact" variant="ghost">
              Contact Me
            </Button>
          </div>
        </motion.div>

        <motion.div
          initial={{ opacity: 0, scale: 0.9 }}
          animate={{ opacity: 1, scale: 1 }}
          transition={{ duration: 0.6, delay: 0.1 }}
          className="relative mx-auto aspect-square w-full max-w-md"
        >
          <div className="absolute inset-0 rounded-3xl bg-gradient-to-br from-indigo-500 via-violet-500 to-fuchsia-500 opacity-20 blur-3xl" />
          <div className="relative flex h-full w-full items-center justify-center rounded-3xl border border-neutral-200 bg-white/60 shadow-2xl backdrop-blur-sm dark:border-neutral-800 dark:bg-neutral-900/60">
            <div className="w-4/5 space-y-3 rounded-xl bg-neutral-900 p-6 font-mono text-xs text-neutral-100 shadow-lg dark:bg-black">
              <div className="flex gap-1.5">
                <span className="h-2.5 w-2.5 rounded-full bg-red-500" />
                <span className="h-2.5 w-2.5 rounded-full bg-yellow-500" />
                <span className="h-2.5 w-2.5 rounded-full bg-green-500" />
              </div>
              <p><span className="text-fuchsia-400">const</span> <span className="text-sky-400">dev</span> = {'{'}</p>
              <p className="pl-4">stack: [<span className="text-emerald-400">'React'</span>, <span className="text-emerald-400">'Laravel'</span>],</p>
              <p className="pl-4">ships: <span className="text-orange-400">true</span></p>
              <p>{'}'}</p>
            </div>
          </div>
        </motion.div>
      </Container>
    </section>
  )
}
