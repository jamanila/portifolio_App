import { Navigate, Outlet } from 'react-router-dom'
import { useAuth } from '@/contexts/AuthContext'

export default function ProtectedRoute() {
  const { user, isLoading } = useAuth()

  if (isLoading) {
    return <div className="flex min-h-svh items-center justify-center text-neutral-400">Loading…</div>
  }

  if (!user) {
    return <Navigate to="/admin/login" replace />
  }

  return <Outlet />
}
