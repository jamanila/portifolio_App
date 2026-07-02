import { useState, type FormEvent } from 'react'
import { Navigate, useNavigate } from 'react-router-dom'
import { Helmet } from 'react-helmet-async'
import { motion } from 'framer-motion'
import { useAuth } from '@/contexts/AuthContext'

export default function Login() {
  const { user, isLoading, login } = useAuth()
  const navigate = useNavigate()
  const [email, setEmail] = useState('')
  const [password, setPassword] = useState('')
  const [error, setError] = useState<string | null>(null)
  const [isSubmitting, setIsSubmitting] = useState(false)

  if (!isLoading && user) {
    return <Navigate to="/admin" replace />
  }

  const handleSubmit = async (e: FormEvent) => {
    e.preventDefault()
    setError(null)
    setIsSubmitting(true)
    try {
      await login(email, password)
      navigate('/admin')
    } catch {
      setError('Invalid email or password.')
    } finally {
      setIsSubmitting(false)
    }
  }

  const inputClass =
    'w-full rounded-lg border border-neutral-300 bg-white px-4 py-2.5 text-sm text-neutral-900 focus:border-indigo-500 focus:outline-none dark:border-neutral-700 dark:bg-neutral-900 dark:text-white'

  return (
    <>
      <Helmet>
        <title>Admin Login</title>
      </Helmet>

      <div className="flex min-h-svh items-center justify-center bg-neutral-50 px-4 dark:bg-neutral-950">
        <motion.form
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.4 }}
          onSubmit={handleSubmit}
          className="w-full max-w-sm rounded-2xl border border-neutral-200 bg-white p-8 shadow-sm dark:border-neutral-800 dark:bg-neutral-900"
        >
          <h1 className="text-xl font-semibold text-neutral-900 dark:text-white">Admin Login</h1>
          <p className="mt-1 text-sm text-neutral-500 dark:text-neutral-400">Sign in to manage your portfolio.</p>

          <div className="mt-6 space-y-4">
            <div>
              <label htmlFor="email" className="mb-1.5 block text-sm font-medium text-neutral-700 dark:text-neutral-300">
                Email
              </label>
              <input
                id="email"
                type="email"
                required
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                className={inputClass}
              />
            </div>
            <div>
              <label htmlFor="password" className="mb-1.5 block text-sm font-medium text-neutral-700 dark:text-neutral-300">
                Password
              </label>
              <input
                id="password"
                type="password"
                required
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                className={inputClass}
              />
            </div>
          </div>

          {error && <p className="mt-4 text-sm text-red-600">{error}</p>}

          <button
            type="submit"
            disabled={isSubmitting}
            className="mt-6 w-full rounded-full bg-gradient-to-r from-indigo-600 to-violet-600 px-6 py-2.5 text-sm font-semibold text-white transition-all hover:from-indigo-500 hover:to-violet-500 disabled:opacity-60"
          >
            {isSubmitting ? 'Signing in…' : 'Sign In'}
          </button>
        </motion.form>
      </div>
    </>
  )
}
