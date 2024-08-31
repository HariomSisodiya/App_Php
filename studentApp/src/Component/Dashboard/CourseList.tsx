import { useState, useEffect } from 'react'
import videosData from '../VideoData.ts'

interface Video {
  id: string
  title: string
  description: string
  category: string
  url: string
}

export default function InteractiveCourseList() {
  const [data, setData] = useState<Video[]>([])
  const [filteredData, setFilteredData] = useState<Video[]>([])
  const [searchTerm, setSearchTerm] = useState('')
  const [selectedCategory, setSelectedCategory] = useState('all')

  useEffect(() => {
    // Simulating API call
      setData(videosData.videos)
      setFilteredData(videosData.videos)
  }, [])

  useEffect(() => {
    const results = data.filter(video =>
      (video.title.toLowerCase().includes(searchTerm.toLowerCase()) ||
       video.description.toLowerCase().includes(searchTerm.toLowerCase())) &&
      (selectedCategory === 'all' || video.category === selectedCategory)
    )
    setFilteredData(results)
  }, [searchTerm, selectedCategory, data])

  const uniqueCategories = Array.from(new Set(data.map(video => video.category)))

  const handleVideoClick = (url: string) => {
    window.open(url, '_blank')
  }

  return (
    <div className="w-75 mt-5 me-5">
      <h1 className="text-center mb-4">Courses List</h1>
      
      <div className="mb-4 d-flex flex-column flex-sm-row justify-content-between align-items-center">
        <div className="d-flex align-items-center mb-3 mb-sm-0">
          <input
            type="text"
            placeholder="Search courses..."
            value={searchTerm}
            onChange={(e) => setSearchTerm(e.target.value)}
            className="form-control me-2"
          />
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" className="ms-2">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
          </svg>
        </div>
        
        <div className="d-flex align-items-center">
          <span className="me-2">Sort by:</span>
          <select
            value={selectedCategory}
            onChange={(e) => setSelectedCategory(e.target.value)}
            className="form-select"
          >
            <option value="all">All Categories</option>
            {uniqueCategories.map(category => (
              <option key={category} value={category}>{category}</option>
            ))}
          </select>
        </div>
      </div>

      <table className="table table-striped table-bordered">
        <thead>
          <tr>
            <th className="text-muted">S.No</th>
            <th className="text-muted">Course Title</th>
            <th className="text-muted">Description</th>
            <th className="text-muted">Category</th>
            <th className="text-muted">Action</th>
          </tr>
        </thead>
        <tbody>
          {filteredData.map((video, index) => (
            <tr key={index}>
                <td className='text-center' >{video.id}</td>
              <td>{video.title}</td>
              <td>{video.description}</td>
              <td>
                <span className="badge bg-light text-dark">
                  {video.category}
                </span>
              </td>
              <td>
                <button
                  onClick={() => handleVideoClick(video.url)}
                  className="btn btn-success"
                >
                  Watch
                </button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  )
}
