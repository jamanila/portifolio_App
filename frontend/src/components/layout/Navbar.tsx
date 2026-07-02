import { useState } from 'react'
import { NavLink } from 'react-router-dom'
import { AnimatePresence, motion } from 'framer-motion'
import { FaBars, FaXmark, FaSun, FaMoon } from 'react-icons/fa6'
import { useTheme } from '@/contexts/ThemeContext'
import { useSiteData } from '@/contexts/SiteDataContext'

const NAV_LINKS = [
  { to: '/', label: 'Home' },
  { to: '/about', label: 'About' },
  { to: '/projects', label: 'Projects' },
  { to: '/products', label: 'Products' },
  { to: '/services', label: 'Services' },
  { to: '/contact', label: 'Contact' },
]

export default function Navbar() {
  const { theme, toggleTheme } = useTheme()
  const { settings } = useSiteData()
  const [isOpen, setIsOpen] = useState(false)

  const linkClass = ({ isActive }: { isActive: boolean }) =>
    `text-sm font-medium transition-colors ${
      isActive
        ? 'text-indigo-600 dark:text-indigo-400'
        : 'text-neutral-600 hover:text-neutral-900 dark:text-neutral-300 dark:hover:text-white'
    }`

  return (
    <header className="sticky top-0 z-50 border-b border-neutral-200/80 bg-white/80 backdrop-blur-lg dark:border-neutral-800/80 dark:bg-neutral-950/80">
      <nav className="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
        <NavLink to="/" className="text-lg font-semibold text-neutral-900 dark:text-white">
          {settings?.site_name ?? 'Portfolio'}
        </NavLink>

        <div className="hidden items-center gap-8 md:flex">
          {NAV_LINKS.map((link) => (
            <NavLink key={link.to} to={link.to} className={linkClass} end={link.to === '/'}>
              {link.label}
            </NavLink>
          ))}
        </div>

        <div className="flex items-center gap-2">
          <button
            type="button"
            onClick={toggleTheme}
            aria-label="Toggle dark mode"
            className="rounded-full p-2 text-neutral-600 transition-colors hover:bg-neutral-100 dark:text-neutral-300 dark:hover:bg-neutral-800"
          >
            {theme === 'dark' ? <FaSun size={16} /> : <FaMoon size={16} />}
          </button>
          <button
            type="button"
            onClick={() => setIsOpen((v) => !v)}
            aria-label="Toggle menu"
            className="rounded-full p-2 text-neutral-600 transition-colors hover:bg-neutral-100 dark:text-neutral-300 dark:hover:bg-neutral-800 md:hidden"
          >
            {isOpen ? <FaXmark size={18} /> : <FaBars size={18} />}
          </button>
        </div>
      </nav>

      <AnimatePresence>
        {isOpen && (
          <motion.div
            initial={{ height: 0, opacity: 0 }}
            animate={{ height: 'auto', opacity: 1 }}
            exit={{ height: 0, opacity: 0 }}
            transition={{ duration: 0.2 }}
            className="overflow-hidden border-t border-neutral-200 dark:border-neutral-800 md:hidden"
          >
            <div className="flex flex-col gap-4 px-4 py-4 sm:px-6">
              {NAV_LINKS.map((link) => (
                <NavLink
                  key={link.to}
                  to={link.to}
                  className={linkClass}
                  end={link.to === '/'}
                  onClick={() => setIsOpen(false)}
                >
                  {link.label}
                </NavLink>
              ))}
            </div>
          </motion.div>
        )}
      </AnimatePresence>
    </header>
  )
}
