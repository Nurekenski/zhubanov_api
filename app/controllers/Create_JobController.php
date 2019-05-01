 <?php
namespace Controllers;

use Models\Signup;

use Models\Job;

use Lib\Validate;
use Lib\Functions;


class Create_JobController extends Controller
{
    /**
     * @param $request
     * @param $response
     * @param array $args
     * @return mixed
     * @throws \Exception
     */

    public function get($request, $response, $args = [])
    {
        // $is_job = $request->getAttribute('is_job');
        $job_id = $this->getParam('job_id');
        $jobData = Job::getJobData($job_id);
        return $jobData ? $this->success(OK, $jobData)
            : $this->error(UNAUTHORIZED, NOT_AUTHORIZED, "Not authorized");
    }


}
?>
