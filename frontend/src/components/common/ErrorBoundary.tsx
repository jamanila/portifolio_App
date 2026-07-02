import { Component, type ErrorInfo, type ReactNode } from 'react'
import Container from './Container'
import Button from '../ui/Button'

interface ErrorBoundaryProps {
  children: ReactNode
}

interface ErrorBoundaryState {
  hasError: boolean
}

export default class ErrorBoundary extends Component<ErrorBoundaryProps, ErrorBoundaryState> {
  state: ErrorBoundaryState = { hasError: false }

  static getDerivedStateFromError(): ErrorBoundaryState {
    return { hasError: true }
  }

  componentDidCatch(error: Error, info: ErrorInfo) {
    console.error('Unhandled UI error:', error, info)
  }

  render() {
    if (this.state.hasError) {
      return (
        <div className="flex min-h-svh items-center bg-white dark:bg-neutral-950">
          <Container className="py-24 text-center">
            <p className="text-sm font-semibold uppercase tracking-wide text-red-600 dark:text-red-400">
              Something went wrong
            </p>
            <h1 className="mt-2 text-3xl font-bold text-neutral-900 dark:text-white sm:text-4xl">
              An unexpected error occurred
            </h1>
            <p className="mx-auto mt-4 max-w-md text-neutral-500 dark:text-neutral-400">
              Please try reloading the page. If the problem persists, contact the site owner.
            </p>
            <div className="mt-8">
              <Button onClick={() => window.location.reload()} variant="primary">
                Reload Page
              </Button>
            </div>
          </Container>
        </div>
      )
    }

    return this.props.children
  }
}
