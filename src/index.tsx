import { LocationProvider, Router, Route, hydrate, prerender as ssr } from 'preact-iso';
import { useState } from 'preact/hooks'

const Home = () => {
  return <h2>Home!</h2>
}

const Profile = () => {
  return <h2>Profile!</h2>
}

const NotFound = () => {
  return <h2>Not Found!</h2>
}

const App = () => {
  const [count, setCount] = useState(0)

  return (
    <>
      <h1>Hello World</h1>
      <button onClick={() => setCount((count) => count + 1)}>
        count is {count}
      </button>
      <LocationProvider>
        <Router>
          <Route path="/" component={Home} />
          <Route path="/profiles" component={Profile} />
          <Route path="*" component={NotFound} />
        </Router>
      </LocationProvider>
    </>
  )
}

if (typeof window !== 'undefined') {
	hydrate(<App />, document.getElementById('app'));
}

export async function prerender(data) {
	return await ssr(<App {...data} />);
}
