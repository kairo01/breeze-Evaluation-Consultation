/**
 * Appointment Status Management
 *
 * This script handles the appointment status updates and ensures
 * that the UI reflects the correct state of appointments.
 */

document.addEventListener("DOMContentLoaded", () => {
    // Check if we're on the appointment history page
    if (document.getElementById("appointment-table")) {
      // Refresh appointment statuses on page load
      refreshAppointmentStatuses()
  
      // Set up periodic refresh
      setInterval(refreshAppointmentStatuses, 30000) // Every 30 seconds
    }
  })
  
  /**
   * Refresh the status of all appointments on the page
   */
  function refreshAppointmentStatuses() {
    const appointmentRows = document.querySelectorAll("[data-appointment-id]")
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content")
  
    appointmentRows.forEach((row) => {
      const appointmentId = row.getAttribute("data-appointment-id")
      const endpoint = window.location.pathname.includes("student")
        ? `/student/appointment-details/${appointmentId}`
        : window.location.pathname.includes("consultation")
          ? `/consultation/appointment-details/${appointmentId}`
          : `/department-head/appointment-details/${appointmentId}`
  
      fetch(endpoint, {
        headers: {
          "X-CSRF-TOKEN": csrfToken,
          Accept: "application/json",
        },
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`)
          }
          return response.json()
        })
        .then((data) => {
          updateAppointmentRow(row, data)
        })
        .catch((error) => {
          console.error("Error refreshing appointment status:", error)
        })
    })
  }
  
  /**
   * Update a single appointment row with the latest data
   */
  function updateAppointmentRow(row, data) {
    // Update status cell
    const statusCell = row.querySelector(".status-cell")
    if (statusCell) {
      let statusHTML = ""
  
      if (data.status === "Completed") {
        statusHTML = `<span class="inline-block rounded-full px-3 py-1 text-sm font-semibold text-green-900 bg-green-200">Completed</span>`
      } else if (data.status === "Not Completed") {
        statusHTML = `<span class="inline-block rounded-full px-3 py-1 text-sm font-semibold text-red-900 bg-red-200">Not Completed</span>`
      } else {
        statusHTML = `<span class="inline-block rounded-full px-3 py-1 text-sm font-semibold text-blue-900 bg-blue-200">${data.status}</span>`
      }
  
      statusCell.innerHTML = statusHTML
    }
  
    // Update action cell if it exists (student view)
    const actionCell = row.querySelector(".action-cell")
    if (actionCell && (data.status === "Completed" || data.status === "Not Completed")) {
      const appointmentId = row.getAttribute("data-appointment-id")
  
      // If completed or not completed, only show view details button
      actionCell.innerHTML = `
              <button onclick="viewDetails(${appointmentId})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                  View Details
              </button>
          `
  
      // Add reschedule button for not completed appointments
      if (data.status === "Not Completed") {
        actionCell.innerHTML += `
                  <a href="/student/reschedule/${appointmentId}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded ml-2">
                      Reschedule
                  </a>
              `
      }
    }
  }
  
  