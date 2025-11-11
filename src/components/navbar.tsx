const Navbar = () => {
  return (
    <div className='navbar !h-[4rem] bg-base-100 sticky top-0 z-50'>
      <div className='container mx-auto flex'>
        <div className='my-auto navbar-start'>
          <a className='btn btn-ghost text-xl'>Mimpi Maya</a>
        </div>
        <div className='my-auto navbar-end'>
          <ul className='menu menu-horizontal px-1'>
            <li><a>Link</a></li>
            <li>
              <details>
                <summary>Parent</summary>
                <ul className='bg-base-100 rounded-t-none p-2'>
                  <li><a>Link 1</a></li>
                  <li><a>Link 2</a></li>
                </ul>
              </details>
            </li>
          </ul>
        </div>
      </div>
    </div>
  )
}

export default Navbar;
