<script>
    /**
     * add status check
     * @param event
     * @return {Promise<void>}
     */
    async function onAddActionSubmit(event) {
        event.preventDefault();
        let form = event.currentTarget;
        let formData = new FormData(form);
        let actionTask = form.querySelector("#action-task");
        if (actionTask) {
            formData.append("taskUrl", actionTask.value);
        }
        let actionDate = form.querySelector("#action-date");
        if (actionDate) {
            formData.append("date", actionDate.value);
        }
        let actionStartTime = form.querySelector("#action-start-time");
        if (actionStartTime) {
            formData.append("startTime", actionStartTime.value);
        }
        let actionEndTime = form.querySelector("#action-end-time");
        if (actionEndTime) {
            formData.append("endTime", actionEndTime.value);
        }
        let url = new URL("/Api/AddAction.php", window.location.origin);
        let response = await fetch (
            url.href,
            {method: "POST", body: formData}
        ).then((response) => response.json());
        if (response.success)
        {
            alert("Action successfully added");
        }
    }

    function onActionStartTimeChange (event) {
        let endDatetimeElement = document.querySelector("#action-end-time");
        endDatetimeElement.min = event.currentTarget.value;
    }

    function onActionEndTimeChange (event) {
        let endDatetimeElement = document.querySelector("#action-start-time");
        endDatetimeElement.max = event.currentTarget.value;
    }

    function setDefaults() {
        let now = new Date();
        let year = now.getFullYear().toString();
        let month = (now.getMonth() + 1).toString().padStart(2, "0");
        let day = now.getDate().toString().padStart(2, "0");
        let hours = now.getHours().toString().padStart(2, "0");
        let minutes = (now.getMinutes() - (now.getMinutes() % 5) + 5).toString().padStart(2, "0");
        document.querySelector("#action-date").value = `${year}-${month}-${day}`;
        document.querySelectorAll("#action-start-time, #action-end-time")
            .forEach((element) => element.value = `${hours}:${minutes}`);
    }

    window.addEventListener('load', function () {
        document.querySelector("#add-action")?.addEventListener("submit", onAddActionSubmit);
        document.querySelector("#action-start-time")?.addEventListener("change", onActionStartTimeChange);
        document.querySelector("#action-end-time")?.addEventListener("change", onActionEndTimeChange);
        setDefaults();
    });
</script>
<form id="add-action">
  <div>
    <div>
      <label for="action-task">????????????</label>
    </div>
    <div>
      <input id="action-task" type="url" autocomplete="off" value="https://google.com" required>
    </div>
  </div>
  <div>
    <div>
      <label for="action-date">????????</label>
    </div>
    <div>
      <input id="action-date" type="date" required>
    </div>
  </div>
  <div>
    <div>
      <label for="action-start-time">?????????? ????????????</label>
    </div>
    <div>
      <input id="action-start-time" type="time" step="300" required>
    </div>
  </div>
  <div>
    <div>
      <label for="action-end-time">?????????? ??????????????????</label>
    </div>
    <div>
      <input id="action-end-time" type="time" step="300" required>
    </div>
  </div>
  <div>
    <input type="submit" value="????????????????">
  </div>
</form>